<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;


Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    
    Route::get('/farmers', [FarmerController::class, 'dashboard'])->name('farmers');
    Route::get('/buyer/dashboard/{category?}', [BuyerController::class, 'dashboard'])->name('buyer.dashboard');
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/farmer/orders', [FarmerController::class, 'orders'])->name('farmer.orders');
    Route::post('/farmer/store-product', [FarmerController::class, 'storeProduct'])->name('farmer.storeProduct');
    Route::get('/farmer/add-product', [FarmerController::class, 'addProduct'])->name('farmer.addProduct');
    Route::get('/farmer/my-products', [FarmerController::class, 'myProducts'])->name('farmer.myProducts');
   
    Route::get('/farmer/edit-product/{id}', [FarmerController::class, 'editProduct'])->name('farmer.editProduct');
    Route::post('/farmer/update-product/{id}', [FarmerController::class, 'updateProduct'])->name('farmer.updateProduct');
    Route::delete('/farmer/delete-product/{id}', [FarmerController::class, 'deleteProduct'])->name('farmer.deleteProduct');
    Route::get('/farmer/orders', [FarmerController::class, 'orders'])->name('farmer.orders');
        Route::post('/farmer/update-order-status', [FarmerController::class, 'updateOrderStatus'])->name('farmer.updateOrderStatus');
     Route::get('/farmer/profile', [FarmerController::class, 'profile'])->name('farmer.profile');
    Route::get('/farmer/update-profile', [FarmerController::class, 'updateProfile'])->name('farmer.updateProfile');
   
    Route::post('/farmer/update-profile', [FarmerController::class, 'updateProfilePost'])->name('farmer.updateProfilePost');
    Route::get('/farmer/change-password', [FarmerController::class, 'changePassword'])->name('farmer.changePassword');
    
    Route::post('/farmer/change-password', [FarmerController::class, 'changePasswordPost'])->name('farmer.changePasswordPost');
    Route::get('/farmer/support', [FarmerController::class, 'support'])->name('farmer.support');
    Route::post('/farmer/create-support-ticket', [FarmerController::class, 'createSupportTicket'])->name('farmer.createSupportTicket');
    Route::get('/buyer/dashboard/{category?}', [BuyerController::class, 'dashboard'])->name('buyer.dashboard');
    Route::post('/buyer/add-to-cart', [BuyerController::class, 'addToCart'])->name('buyer.addToCart');
    Route::get('/buyer/cart', [BuyerController::class, 'cart'])->name('buyer.cart');
    Route::get('/buyer/orders', [BuyerController::class, 'orders'])->name('buyer.orders');
    Route::get('/buyer/profile', [BuyerController::class, 'profile'])->name('buyer.profile');
    Route::post('/buyer/update-profile', [BuyerController::class, 'updateProfile'])->name('buyer.updateProfile');
    Route::post('/buyer/change-password', [BuyerController::class, 'changePassword'])->name('buyer.changePassword');
    Route::get('/buyer/support', [BuyerController::class, 'support'])->name('buyer.support');
    Route::post('/buyer/create-support-ticket', [BuyerController::class, 'createSupportTicket'])->name('buyer.createSupportTicket');
    Route::get('/buyer/product/{id}', [BuyerController::class, 'productDetail'])->name('buyer.productDetail');
    Route::get('/buyer/edit-profile', [BuyerController::class, 'editProfile'])->name('buyer.editProfile');
    Route::get('/buyer/support-ticket', [BuyerController::class, 'supportTicket'])->name('buyer.supportTicket');
    Route::post('/buyer/remove-from-cart/{cartId}', [BuyerController::class, 'removeFromCart'])->name('buyer.removeFromCart');
    Route::post('/buyer/update-cart-quantity/{cartId}', [BuyerController::class, 'updateCartQuantity'])->name('buyer.updateCartQuantity');
    Route::match(['get', 'post'], '/buyer/payment', [BuyerController::class, 'payment'])->name('buyer.payment');
    Route::post('/buyer/place-order', [BuyerController::class, 'placeOrder'])->name('buyer.placeOrder');
    Route::match(['get', 'post'], '/buyer/order-confirmed/{orderId?}', [BuyerController::class, 'orderConfirmed'])->name('buyer.orderConfirmed');
    Route::get('/buyer/online-payment', [BuyerController::class, 'showOnlinePayment'])->name('buyer.onlinePayment');
    Route::post('/buyer/online-payment', [BuyerController::class, 'onlinePayment'])->name('buyer.onlinePayment.post');
    Route::get('/buyer/checkout', [BuyerController::class, 'checkout'])->name('buyer.checkout');
    
    });