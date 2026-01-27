<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Order;
use App\Models\Support;

class AdminController extends Controller
{
    public function dashboard()
    {
        $adminName = auth()->user()->FullName ?? 'Admin';

        // Stats
        $totalFarmers = DB::table('users')->where('Role', 'Farmer')->count();
        $totalBuyers = DB::table('users')->where('Role', 'Buyer')->count();
        $totalOrders = DB::table('orders')->count();
        $totalRevenue = DB::table('orders')->where('Status', 'Delivered')->sum('TotalAmount');

        // Recent orders (5)
        $recentOrders = DB::table('orders as o')
            ->join('users as u', 'u.UserID', '=', 'o.BuyerID')
            ->select('o.OrderID', 'u.FullName as BuyerName', 'o.Status', 'o.OrderDate', 'o.TotalAmount',
                     DB::raw('(SELECT COALESCE(SUM(oi.Quantity), 0) FROM orderitems oi WHERE oi.OrderID = o.OrderID) as Items'))
            ->orderBy('o.OrderDate', 'desc')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('adminName', 'totalFarmers', 'totalBuyers', 'totalOrders', 'totalRevenue', 'recentOrders'));
    }

    public function buyers()
    {
        $buyers = DB::table('users')->where('Role', 'Buyer')->get();
        return view('admin.buyers', compact('buyers'));
    }

    public function farmers()
    {
        $farmers = DB::table('users')->where('Role', 'Farmer')->orderBy('UserID', 'desc')->get();
        return view('admin.farmers', compact('farmers'));
    }

    public function deleteBuyer($id)
    {
        DB::transaction(function () use ($id) {
            // Delete order items for this buyer's orders
            DB::table('orderitems')->whereIn('OrderID', function ($query) use ($id) {
                $query->select('OrderID')->from('orders')->where('BuyerID', $id);
            })->delete();

            // Delete orders
            DB::table('orders')->where('BuyerID', $id)->delete();

            // Delete the buyer
            DB::table('users')->where('UserID', $id)->where('Role', 'Buyer')->delete();
        });

        return redirect()->route('admin.buyers')->with('success', 'Buyer deleted successfully.');
    }

    public function deleteFarmer($id)
    {
        DB::transaction(function () use ($id) {
            // Delete products for this farmer
            DB::table('products')->where('FarmerID', $id)->delete();

            // Delete order items for this farmer's products
            DB::table('orderitems')->whereIn('ProductID', function ($query) use ($id) {
                $query->select('ProductID')->from('products')->where('FarmerID', $id);
            })->delete();

            // Delete orders that only have this farmer's products (if any)
            DB::table('orders')->whereNotIn('OrderID', function ($query) {
                $query->select('OrderID')->from('orderitems');
            })->delete();

            // Delete the farmer
            DB::table('users')->where('UserID', $id)->where('Role', 'Farmer')->delete();
        });

        return redirect()->route('admin.farmers')->with('success', 'Farmer deleted successfully.');
    }

    public function products()
    {
        $products = Product::with('farmer')->orderBy('ProductID', 'desc')->get();
        $farmers = DB::table('users')->where('Role', 'Farmer')->orderBy('FullName')->get();
        return view('admin.products', compact('products', 'farmers'));
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'ProductName' => 'required|string|max:255',
            'Category' => 'nullable|string|max:255',
            'Description' => 'nullable|string',
            'Price' => 'required|numeric|min:0',
            'Quantity' => 'required|integer|min:0',
            'FarmerID' => 'required|exists:users,UserID',
            'Image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['ProductName', 'Category', 'Description', 'Price', 'Quantity', 'FarmerID']);

        if ($request->hasFile('Image')) {
            $data['Image'] = $request->file('Image')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('admin.products')->with('success', 'Product added successfully.');
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'ProductName' => 'required|string|max:255',
            'Category' => 'nullable|string|max:255',
            'Description' => 'nullable|string',
            'Price' => 'required|numeric|min:0',
            'Quantity' => 'required|integer|min:0',
            'FarmerID' => 'required|exists:users,UserID',
            'Image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['ProductName', 'Category', 'Description', 'Price', 'Quantity', 'FarmerID']);

        if ($request->hasFile('Image')) {
            // Delete old image if exists
            if ($product->Image) {
                Storage::disk('public')->delete($product->Image);
            }
            $data['Image'] = $request->file('Image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('admin.products')->with('success', 'Product updated successfully.');
    }

    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);

        // Delete image if exists
        if ($product->Image && file_exists(public_path('farmer/' . $product->Image))) {
            unlink(public_path('farmer/' . $product->Image));
        }

        $product->delete();

        return redirect()->route('admin.products')->with('success', 'Product deleted successfully.');
    }

    public function orders()
    {
        $orders = Order::with('buyer')
            ->select('orders.*', DB::raw('(SELECT COALESCE(SUM(oi.Quantity), 0) FROM orderitems oi WHERE oi.OrderID = orders.OrderID) as Items'))
            ->orderBy('OrderDate', 'desc')
            ->get();

        return view('admin.orders', compact('orders'));
    }

    public function updateOrderStatus(Request $request)
    {
        $request->validate([
            'OrderID' => 'required|exists:orders,OrderID',
            'Status' => 'required|in:Pending,Shipped,Delivered,Cancelled',
        ]);

        Order::where('OrderID', $request->OrderID)->update(['Status' => $request->Status]);

        return redirect()->route('admin.orders')->with('success', 'Order status updated successfully.');
    }

    public function support()
    {
        $tickets = Support::with('user')->orderBy('CreatedAt', 'desc')->get();
        return view('admin.support', compact('tickets'));
    }

    public function toggleSupportStatus($id)
    {
        $ticket = Support::findOrFail($id);
        $ticket->Status = $ticket->Status === 'Open' ? 'Closed' : 'Open';
        $ticket->save();

        return redirect()->route('admin.support')->with('success', 'Ticket status updated successfully.');
    }
}
