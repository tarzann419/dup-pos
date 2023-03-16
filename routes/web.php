<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\EmployeeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('index');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';





Route::controller(AdminController::class)->group(function () {
    Route::middleware(['auth'])->group(function(){
    Route::get('/admin/logout', 'AdminDestroy')->name('admin.logout');
    Route::get('/logout', 'AdminLogoutPage')->name('admin.logout.page');
    Route::get('/admin/profile', 'AdminProfilePage')->name('admin.profile');
    Route::post('/admin/profile/store', 'AdminProfileStore')->name('admin.profile.store');
    Route::get('/admin/change/password', 'ChangePassword')->name('change.password');
    Route::post('/admin/update/password', 'UpdatePassword')->name('update.password');

});
});



Route::controller(CustomerController::class)->group(function () {
    Route::get('/all/customer', 'AllCustomer')->name('all.customer');
    Route::get('/add/customer', 'AddCustomer')->name('add.customer');
    Route::post('/store/customer', 'StoreCustomer')->name('store.customer');
    Route::get('/edit/customer/{$id}', 'EditCustomer')->name('edit.customer');
    Route::post('/update/customer', 'UpdateCustomer')->name('customer.update');




    
});
