<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\EmployeeController;
use App\Http\Controllers\Backend\SupplierController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ExpenseController;

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

require __DIR__ . '/auth.php';



// Admin Controller Route

Route::controller(AdminController::class)->group(function () {
    Route::middleware(['auth'])->group(function () {
        Route::get('/admin/logout', 'AdminDestroy')->name('admin.logout');
        Route::get('/logout', 'AdminLogoutPage')->name('admin.logout.page');
        Route::get('/admin/profile', 'AdminProfilePage')->name('admin.profile');
        Route::post('/admin/profile/store', 'AdminProfileStore')->name('admin.profile.store');
        Route::get('/admin/change/password', 'ChangePassword')->name('change.password');
        Route::post('/admin/update/password', 'UpdatePassword')->name('update.password');
    });
});


// Customer Controller Route

Route::controller(CustomerController::class)->group(function () {
    Route::get('/all/customer', 'AllCustomer')->name('all.customer');
    Route::get('/add/customer', 'AddCustomer')->name('add.customer');
    Route::post('/store/customer', 'StoreCustomer')->name('store.customer');
    Route::get('/edit/customer/{id}', 'EditCustomer')->name('edit.customer');
    Route::post('/update/customer', 'UpdateCustomer')->name('customer.update');
});




// Supplier Controller Route

Route::controller(SupplierController::class)->group(function () {
    Route::get('/all/supplier', 'AllSupplier')->name('all.supplier');
    Route::get('/add/supplier', 'AddSupplier')->name('add.supplier');
    Route::post('/store/supplier', 'StoreSupplier')->name('supplier.store');
    Route::get('/edit/supplier/{id}', 'EditSupplier')->name('edit.supplier');
    Route::post('/update/supplier', 'UpdateSupplier')->name('supplier.update');
    Route::get('/delete/supplier/{id}', 'DeleteSupplier')->name('delete.supplier');
    // Route::get('/details/supplier/{$id}', 'DetailsSupplier')->name('details.supplier');

});

// Category Controller Route

Route::controller(CategoryController::class)->group(function () {
    Route::get('/all/category', 'AllCategory')->name('all.category');
    Route::post('/store/category', 'StoreCategory')->name('category.store');
    Route::get('/edit/category/{id}', 'EditCategory')->name('edit.category');
    Route::post('/update/category', 'UpdateCategory')->name('category.update');
    Route::get('/delete/category/{id}', 'DeleteCategory')->name('delete.category');
});


// Product Controller Route
Route::controller(ProductController::class)->group(function () {
    Route::get('/all/product', 'AllProduct')->name('all.product');
    Route::get('/add/product', 'AddProduct')->name('add.product');
    Route::post('/store/product', 'StoreProduct')->name('product.store');
    Route::get('/edit/product/{id}', 'EditProduct')->name('edit.product');
    Route::post('/update/product', 'UpdateProduct')->name('product.update');
    Route::get('/delete/product/{id}', 'DeleteProduct')->name('delete.product');

    Route::get('/barcode/product/{id}', 'BarcodeProduct')->name('barcode.product');

    Route::get('/import/product', 'ImportProduct')->name('import.product');
    Route::get('/export', 'Export')->name('export');
    Route::post('/import', 'Import')->name('import');
});




Route::controller(ExpenseController::class)->group(function () {
    Route::get('/add/expense', 'AddExpense')->name('add.expense');
    Route::post('/store/expense', 'StoreExpense')->name('expense.store');
    Route::get('/today/expense', 'TodayExpense')->name('today.expense');
    Route::get('/edit/expense/{id}', 'EditExpense')->name('edit.expense');
    Route::post('/update/expense', 'UpdateExpense')->name('expense.update');
    Route::get('/month/expense', 'MonthExpense')->name('month.expense');
    Route::get('/year/expense', 'YearExpense')->name('year.expense');
});
