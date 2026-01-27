<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Support;
use Illuminate\Support\Facades\Hash;

class BuyerController extends Controller
{
    public function dashboard(Request $request, $category = 'All')
    {
        $buyerName = session('username', auth()->user()->FullName ?? 'Buyer');
        $categoryFilter = $category;
        $addedToCart = $request->session()->get('added_to_cart', false);

        if ($category !== 'All') {
            $products = Product::where('Category', $category)->limit(12)->get();
        } else {
            $products = Product::limit(12)->get();
        }

        return view('buyer.dashboard', compact('buyerName', 'products', 'categoryFilter', 'addedToCart'));
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,ProductID',
            'quantity' => 'required|integer|min:1',
        ]);

        $productId = $request->product_id;
        $product = Product::findOrFail($productId);

        // Check if item already in cart
        $cartItem = Cart::where('BuyerID', auth()->id())
                       ->where('ProductID', $productId)
                       ->first();

        if ($cartItem) {
            $cartItem->increment('Quantity', $request->quantity);
        } else {
            Cart::create([
                'BuyerID' => auth()->id(),
                'ProductID' => $productId,
                'Quantity' => $request->quantity,
            ]);
        }

        return redirect()->back()->with('added_to_cart', true);
    }

    public function cart()
    {
        $buyerName = session('username', auth()->user()->FullName ?? 'Buyer');
        $cartItems = Cart::where('BuyerID', auth()->id())->with('product')->get();
        $total = $cartItems->sum(function ($item) {
            return $item->Quantity * $item->product->Price;
        });

        return view('buyer.cart', compact('buyerName', 'cartItems', 'total'));
    }

    public function orders()
    {
        $buyerName = session('username', auth()->user()->FullName ?? 'Buyer');
        $orders = Order::where('BuyerID', auth()->id())->with('orderItems.product')->get();
        return view('buyer.orders', compact('buyerName', 'orders'));
    }

    public function profile()
    {
        $user = auth()->user();
        $buyerName = session('username', auth()->user()->FullName ?? 'Buyer');

        // Get profile stats
        $orderCount = Order::where('BuyerID', auth()->id())->count();
        $totalSpent = Order::where('BuyerID', auth()->id())->sum('TotalAmount');
        $cartCount = Cart::where('BuyerID', auth()->id())->sum('Quantity');

        return view('buyer.profile', compact('user', 'buyerName', 'orderCount', 'totalSpent', 'cartCount'));
    }

    public function support()
    {
        $buyerName = session('username', auth()->user()->FullName ?? 'Buyer');
        $tickets = Support::where('UserID', auth()->id())->get();
        return view('buyer.support', compact('buyerName', 'tickets'));
    }

    public function createSupportTicket(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Support::create([
            'UserID' => auth()->id(),
            'Subject' => $request->subject,
            'Message' => $request->message,
            'Status' => 'Open',
            'CreatedAt' => now(),
        ]);

        return redirect()->back()->with('success', 'Support ticket created successfully!');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->Password)) {
            return redirect()->back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        $user->update([
            'Password' => Hash::make($request->new_password),
        ]);

        return redirect()->back()->with('success', 'Password changed successfully!');
    }

    public function updateCartQuantity(Request $request, $cartId)
    {
        $cartItem = Cart::findOrFail($cartId);

        if ($cartItem->BuyerID !== auth()->id()) {
            abort(403);
        }

        if ($request->action === 'increase') {
            $cartItem->increment('Quantity');
        } elseif ($request->action === 'decrease') {
            if ($cartItem->Quantity > 1) {
                $cartItem->decrement('Quantity');
            }
        }

        return redirect()->back();
    }

    public function removeFromCart($cartId)
    {
        $cartItem = Cart::findOrFail($cartId);

        if ($cartItem->BuyerID !== auth()->id()) {
            abort(403);
        }

        $cartItem->delete();

        return redirect()->back()->with('success', 'Item removed from cart');
    }

    public function checkout()
    {
        $buyerName = session('username', auth()->user()->FullName ?? 'Buyer');
        $cartItems = Cart::where('BuyerID', auth()->id())->with('product')->get();
        $total = $cartItems->sum(function ($item) {
            return $item->Quantity * $item->product->Price;
        });

        return view('buyer.checkout', compact('buyerName', 'cartItems', 'total'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'FullName' => 'required|string|max:255',
            'Email' => 'required|email|unique:users,Email,' . auth()->id() . ',UserID',
            'Phone' => 'nullable|string|max:15',
            'Gender' => 'nullable|in:Male,Female,Other',
            'About' => 'nullable|string',
        ]);

        auth()->user()->update($request->only(['FullName', 'Email', 'Phone', 'Gender', 'About']));

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'address' => 'required|string',
            'payment_method' => 'required|in:cod,online',
        ]);

        $cartItems = Cart::where('BuyerID', auth()->id())->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->withErrors(['cart' => 'Your cart is empty']);
        }

        $total = $cartItems->sum(function ($item) {
            return $item->Quantity * $item->product->Price;
        }) + 50; // Including delivery charge

            // Create order
            $order = Order::create([
                'BuyerID' => auth()->id(),
                'FullName' => auth()->user()->FullName,
                'Phone' => auth()->user()->Phone ?? '',
                'Email' => auth()->user()->Email,
                'TotalAmount' => $total,
                'Status' => 'Pending',
                'OrderDate' => now(),
                'DeliveryAddress' => $request->address,
                'City' => '',
                'Pincode' => '',
                'PaymentMethod' => $request->payment_method,
            ]);

            // Create order items
        foreach ($cartItems as $item) {
            OrderItem::create([
                'OrderID' => $order->OrderID,
                'ProductID' => $item->ProductID,
                'Quantity' => $item->Quantity,
                'Price' => $item->product->Price,
            ]);
        }

        // Clear cart
        Cart::where('BuyerID', auth()->id())->delete();

        return redirect()->route('buyer.orderConfirmed', ['orderId' => $order->OrderID])->with('success', 'Order placed successfully!');
    }

    public function orderConfirmed(Request $request, $orderId = null)
    {
        $buyerName = session('username', auth()->user()->FullName ?? 'Buyer');

        if ($request->isMethod('post')) {
            try {
                // Handle order creation from checkout page
                $request->validate([
                    'full_name' => 'required|string',
                    'phone' => 'required|string',
                    'email' => 'required|email',
                    'address' => 'required|string',
                    'city' => 'required|string',
                    'pincode' => 'required|string',
                    'payment_method' => 'required|in:cod,online',
                ]);

                $cartItems = Cart::where('BuyerID', auth()->id())->with('product')->get();

                if ($cartItems->isEmpty()) {
                    return redirect()->back()->withErrors(['cart' => 'Your cart is empty']);
                }

                $total = $cartItems->sum(function ($item) {
                    return $item->Quantity * $item->product->Price;
                }) + 50; // Including delivery charge

                // Create order
                $order = Order::create([
                    'BuyerID' => auth()->id(),
                    'FullName' => $request->full_name,
                    'Phone' => $request->phone,
                    'Email' => $request->email,
                    'TotalAmount' => $total,
                    'Status' => 'Pending',
                    'OrderDate' => now(),
                    'DeliveryAddress' => $request->address,
                    'City' => $request->city,
                    'Pincode' => $request->pincode,
                    'PaymentMethod' => $request->payment_method,
                ]);

                // Create order items
                foreach ($cartItems as $item) {
                    OrderItem::create([
                        'OrderID' => $order->OrderID,
                        'ProductID' => $item->ProductID,
                        'Quantity' => $item->Quantity,
                        'Price' => $item->product->Price,
                    ]);
                }

                // Clear cart
                Cart::where('BuyerID', auth()->id())->delete();

                return redirect()->route('buyer.orderConfirmed', ['orderId' => $order->OrderID])->with('success', 'Order placed successfully!');
            } catch (\Exception $e) {
                // Log the error and redirect back with error message
                \Log::error('Order creation failed: ' . $e->getMessage());
                return redirect()->back()->withErrors(['error' => 'Failed to create order. Please try again.']);
            }
        } else {
            // Display order details
            $order = Order::where('OrderID', $orderId)->where('BuyerID', auth()->id())->with('orderItems.product')->firstOrFail();
            return view('buyer.order_confirmed', compact('buyerName', 'order'));
        }
    }

    public function productDetail($id)
    {
        $product = Product::findOrFail($id);
        $relatedProducts = Product::where('Category', $product->Category)
                                  ->where('ProductID', '!=', $id)
                                  ->limit(4)
                                  ->get();

        return view('buyer.productdetail', compact('product', 'relatedProducts'));
    }

    public function editProfile()
    {
        $user = auth()->user();
        return view('buyer.edit_profile', compact('user'));
    }

    public function supportTicket()
    {
        return view('buyer.support_ticket');
    }

    public function payment(Request $request)
    {
        if ($request->isMethod('post')) {
            // Set session from checkout
            session([
                'full_name' => $request->full_name,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'city' => $request->city,
                'pincode' => $request->pincode,
                'payment_method' => $request->payment_method,
            ]);
        }

        $cartItems = Cart::where('BuyerID', auth()->id())->with('product')->get();
        $total = $cartItems->sum(function ($item) {
            return $item->Quantity * $item->product->Price;
        });
        $delivery = 50;
        $grandTotal = $total + $delivery;
        $orderId = 'ORD' . time() . auth()->id();

        $fullName = session('full_name', auth()->user()->FullName);
        $phone = session('phone', auth()->user()->Phone ?? '');
        $email = session('email', auth()->user()->Email);
        $address = session('address');
        $city = session('city');
        $pincode = session('pincode');
        $itemsJson = json_encode($cartItems->map(function ($item) {
            return [
                'ProductID' => $item->ProductID,
                'Quantity' => $item->Quantity,
                'Price' => $item->product->Price,
            ];
        }));

        return view('buyer.payment', compact('orderId', 'total', 'delivery', 'grandTotal', 'fullName', 'phone', 'email', 'address', 'city', 'pincode', 'itemsJson'));
    }

    public function showOnlinePayment()
    {
        $cartItems = Cart::where('BuyerID', auth()->id())->with('product')->get();
        $total = $cartItems->sum(function ($item) {
            return $item->Quantity * $item->product->Price;
        });
        $delivery = 50;
        $grandTotal = $total + $delivery;
        $orderId = 'ORD' . time() . auth()->id();

        $fullName = auth()->user()->FullName;
        $phone = auth()->user()->Phone ?? '';
        $email = auth()->user()->Email;
        $address = session('address');
        $city = session('city');
        $pincode = session('pincode');
        $itemsJson = json_encode($cartItems->map(function ($item) {
            return [
                'ProductID' => $item->ProductID,
                'Quantity' => $item->Quantity,
                'Price' => $item->product->Price,
            ];
        }));

        return view('buyer.online_payment', compact('orderId', 'total', 'delivery', 'grandTotal', 'fullName', 'phone', 'email', 'address', 'city', 'pincode', 'itemsJson'));
    }

    public function onlinePayment(Request $request)
    {
        $request->validate([
            'order_id' => 'required|string',
            'full_name' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
            'address' => 'required|string',
            'city' => 'required|string',
            'pincode' => 'required|string',
            'items' => 'required|string',
            'total' => 'required|numeric',
            'delivery' => 'required|numeric',
            'grand_total' => 'required|numeric',
            'payment_method' => 'required|in:cod,online',
            'razorpay_payment_id' => 'nullable|string',
        ]);

        // Decode items JSON
        $items = json_decode($request->items, true);

        // Create order
        $order = Order::create([
            'BuyerID' => auth()->id(),
            'FullName' => $request->full_name,
            'Phone' => $request->phone,
            'Email' => $request->email,
            'TotalAmount' => $request->grand_total,
            'Status' => 'Pending',
            'OrderDate' => now(),
            'DeliveryAddress' => $request->address . ', ' . $request->city . ', ' . $request->pincode,
            'City' => $request->city,
            'Pincode' => $request->pincode,
            'PaymentMethod' => $request->payment_method,
        ]);

        // Create order items
        foreach ($items as $item) {
            OrderItem::create([
                'OrderID' => $order->OrderID,
                'ProductID' => $item['ProductID'],
                'Quantity' => $item['Quantity'],
                'Price' => $item['Price'],
            ]);
        }

        // Clear cart
        Cart::where('BuyerID', auth()->id())->delete();

        return redirect()->route('buyer.orderConfirmed', ['orderId' => $order->OrderID])->with('success', 'Order placed successfully!');
    }
}
