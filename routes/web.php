<?php

use App\Models\Product;
use App\Mail\StockControlMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StockMailController;
use App\Http\Controllers\Backend\PosController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\ExpenseController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\EmployeeController;
use App\Http\Controllers\Backend\SupplierController;

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
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'ControlNotifier'])->name('dashboard');
});




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';



// Admin Controller Route

Route::controller(AdminController::class)->group(function () {

    Route::get('/logout', 'AdminLogoutPage')->name('admin.logout.page');

    Route::middleware(['auth'])->group(function () {
        Route::get('/admin/logout', 'AdminDestroy')->name('admin.logout');
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
    Route::get('/delete/customer/{id}', 'CustomerDelete')->name('delete.customer');
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



Route::controller(PosController::class)->group(function () {
    Route::get('/pos', 'Pos')->name('pos');
    Route::post('/add-cart', 'AddCart');
    Route::get('/allitems', 'AllItem');
    Route::post('/cart-update/{rowId}', 'CartUpdate');
    Route::get('/cart-remove/{rowId}', 'CartRemove');
    Route::post('/create-invoice', 'CreateInvoice');
});


// // route for mailing
// Route::get('/stock', function () {
//     Mail::to('info@dan.com')->send(new StockControlMail());
//     return new StockControlMail();
// })->name('stock.control');

// Route::get('/{prod_name}', function () {
//     return view('emails.stockControl', compact('prod_name'));
// });

Route::get('/stock', [StockMailController::class, 'stockMail']);



Route::controller(InvoiceController::class)->group(function () {
    Route::get('/invoice/all', 'InvoiceAll')->name('invoice.all');
    Route::get('/invoice/add', 'invoiceAdd')->name('invoice.add');
    Route::post('/invoice/store', 'InvoiceStore')->name('invoice.store');

    Route::get('/invoice/pending/list', 'PendingList')->name('invoice.pending.list');
    Route::get('/invoice/delete/{id}', 'InvoiceDelete')->name('invoice.delete');
    Route::get('/invoice/approve/{id}', 'InvoiceApprove')->name('invoice.approve');

    Route::post('/approval/store/{id}', 'ApprovalStore')->name('approval.store');
    Route::get('/print/invoice/list', 'PrintInvoiceList')->name('print.invoice.list');
    Route::get('/print/invoice/{id}', 'PrintInvoice')->name('print.invoice');

    Route::get('/daily/invoice/report', 'DailyInvoiceReport')->name('daily.invoice.report');
    Route::get('/daily/invoice/pdf', 'DailyInvoicePdf')->name('daily.invoice.pdf');
});



///Order All Route 
Route::controller(OrderController::class)->group(function () {

    Route::post('/final-invoice', 'FinalInvoice');
    Route::get('/pending/order', 'PendingOrder')->name('pending.order');
    Route::get('/order/details/{order_id}', 'OrderDetails')->name('order.details');
    Route::post('/order/status/update', 'OrderStatusUpdate')->name('order.status.update');

    Route::get('/complete/order', 'CompleteOrder')->name('complete.order');

    Route::get('/stock', 'StockManage')->name('stock.manage');
    Route::get('/order/invoice-download/{order_id}', 'OrderInvoice');

    //// Due All Route 

    Route::get('/pending/due', 'PendingDue')->name('pending.due');
    Route::get('/order/due/{id}', 'OrderDueAjax');
    Route::post('/update/due', 'UpdateDue')->name('update.due');
});
