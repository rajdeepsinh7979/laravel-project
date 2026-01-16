<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Support;

class FarmerController extends Controller
{
    public function dashboard()
    {
        $farmer_id = Auth::id();
        $farmer_name = Auth::user()->FullName ?? 'Farmer';
    }
    public function addProduct()
    {
        return view('farmer.add-product');
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
                'ProductName' => 'required|string|max:255',
                'Category' => 'required|string',
                'Description' => 'nullable|string',
                'Price' => 'required|numeric|min:0',
                'Quantity' => 'required|integer|min:0',
                'Image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $farmer_id = Auth::id();
        $imagePath = null;

        if ($request->hasFile('Image')) {
            $imagePath = $request->file('Image')->store('products', 'public');
        }

        Product::create([
            'FarmerID' => $farmer_id,
            'ProductName' => $request->ProductName,
            'Category' => $request->Category,
            'Description' => $request->Description,
            'Price' => $request->Price,
            'Quantity' => $request->Quantity,
            'Image' => $imagePath,
        ]);
        return redirect()->route('farmer.myProducts')->with('success', 'Product added successfully!');
    }

    public function myProducts()
    {
        $farmer_id = Auth::id();
        $products = Product::where('FarmerID', $farmer_id)->get();
        return view('farmer.my-products', compact('products'));
    }

        public function editProduct($id)
        {
            $farmer_id = Auth::id();
            $product = Product::where('ProductID', $id)->where('FarmerID', $farmer_id)->firstOrFail();
            return view('farmer.edit-product', compact('product'));
        }

        public function updateProduct(Request $request, $id)
        {
            $request->validate([
                'ProductName' => 'required|string|max:255',
                'Category' => 'required|string',
                'Description' => 'nullable|string',
                'Price' => 'required|numeric|min:0',
                'Quantity' => 'required|integer|min:0',
                'Image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $farmer_id = Auth::id();
            $product = Product::where('ProductID', $id)->where('FarmerID', $farmer_id)->firstOrFail();

            $imagePath = $product->Image;
            if ($request->hasFile('Image')) {
                if ($imagePath) {
                    Storage::disk('public')->delete($imagePath);
                }
                $imagePath = $request->file('Image')->store('products', 'public');
            }

            $product->update([
                'ProductName' => $request->ProductName,
                'Category' => $request->Category,
                'Description' => $request->Description,
                'Price' => $request->Price,
                'Quantity' => $request->Quantity,
                'Image' => $imagePath,
            ]);

            return redirect()->route('farmer.myProducts')->with('success', 'Product updated successfully!');
        }

    public function deleteProduct($id)
    {
        $farmer_id = Auth::id();
        $product = Product::where('ProductID', $id)->where('FarmerID', $farmer_id)->firstOrFail();

        // Delete the image if it exists
        if ($product->Image) {
            Storage::disk('public')->delete($product->Image);
        }

        $product->delete();

        return redirect()->route('farmer.myProducts')->with('success', 'Product deleted successfully!');
    }

    public function orders()
    {
        $farmer_id = Auth::id();
        $orders = DB::table('orders as o')
            ->join('orderitems as oi', 'o.OrderID', '=', 'oi.OrderID')
            ->join('products as p', 'oi.ProductID', '=', 'p.ProductID')
            ->join('users as u', 'o.BuyerID', '=', 'u.UserID')
            ->where('p.FarmerID', $farmer_id)
            ->select('o.OrderID', 'o.Status', 'o.TotalAmount', 'o.OrderDate', 'u.FullName as BuyerName', DB::raw('GROUP_CONCAT(CONCAT(p.ProductName, " (", oi.Quantity, ")") SEPARATOR ", ") as Products'))
            ->groupBy('o.OrderID')
            ->orderBy('o.OrderDate', 'desc')
            ->get();

        return view('farmer.orders', compact('orders'));
    }
    public function updateOrderStatus(Request $request)
    {
        $request->validate([
            'order_id' => 'required|integer',
            'action' => 'required|in:deliver,cancel',
        ]);

        $farmer_id = Auth::id();
        $order_id = $request->order_id;
        $action = $request->action;

        // Check if the order belongs to this farmer
        $orderExists = DB::table('orders as o')
            ->join('orderitems as oi', 'o.OrderID', '=', 'oi.OrderID')
            ->join('products as p', 'oi.ProductID', '=', 'p.ProductID')
            ->where('p.FarmerID', $farmer_id)
            ->where('o.OrderID', $order_id)
            ->exists();

        if (!$orderExists) {
            return redirect()->back()->with('error', 'Order not found or access denied.');
        }

        $status = $action === 'deliver' ? 'Delivered' : 'Cancelled';
        DB::table('orders')->where('OrderID', $order_id)->update(['Status' => $status]);

        return redirect()->back()->with('success', 'Order status updated successfully!');
    }
    public function updateProfile()
    {
        $user = Auth::user();
        return view('farmer.update-profile', compact('user'));
    }

    public function updateProfilePost(Request $request)
    {
        $request->validate([
            'FullName' => 'required|string|max:255',
            'Email' => 'required|email|unique:users,Email,' . Auth::id() . ',UserID',
            'Phone' => 'nullable|string|max:15',
            'FarmName' => 'nullable|string|max:255',
            'Gender' => 'nullable|string',
            'About' => 'nullable|string',
        ]);

        Auth::user()->update($request->only(['FullName', 'Email', 'Phone', 'FarmName', 'Gender', 'About']));

        return redirect()->route('farmer.profile')->with('success', 'Profile updated successfully!');
    }
    public function changePassword()
    {
        return view('farmer.change-password');
    }

    public function changePasswordPost(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->Password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->update(['Password' => Hash::make($request->new_password)]);

        return redirect()->route('farmer.profile')->with('success', 'Password changed successfully!');
    }
}
