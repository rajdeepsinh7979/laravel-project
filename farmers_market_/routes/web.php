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
});