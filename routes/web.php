<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Container\Attributes\Auth;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\InvoicesDetailsController;
use App\Http\Controllers\InvoiceAttachmentsController;
use App\Http\Controllers\InvoiceAchieveController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Invoices_Report;
use App\Http\Controllers\Customer_Report;
use App\Http\Controllers\MailController;
use App\Http\Middleware\CheckStatus;



Route::get('/', function () {
    return view('auth.login');

});


Route::get('/home', ['HomeController@index'])->name('home');


Route::resource('invoices',InvoicesController::class );

Route::resource('sections', SectionsController::class);

Route::resource('products',ProductsController::class );

Route::resource('InvoiceAttachments',InvoiceAttachmentsController::class);

Route::get('/section/{id}', [InvoicesController::class,'getProducts'])->name('getProducts');

Route::get('/InvoicesDetails/{id}', [InvoicesDetailsController::class,'edit'])->name('edit');

Route::get('/InvoicesDetails/{id}', [InvoicesDetailsController::class,'edit'])->name('edit');

Route::get('download/{invoice_number}/{file_name}', [InvoicesDetailsController::class,'get_file'])->name('get_file');


Route::get('View_file/{invoice_number}/{file_name}', [InvoicesDetailsController::class,'open_file'])->name('open_file');

Route::post('delete_file', [InvoicesDetailsController::class,'destroy'])->name('delete_file');

Route::get('edit_invoice/{id}', [InvoicesController::class,'edit'])->name('edit');

Route::get('/Status_show{id}', [InvoicesController::class,'show'])->name('Status_show');

Route::post('/Status_Update{id}', [InvoicesController::class,'Status_Update'])->name('Status_Update');

Route::resource('Archive' , InvoiceAchieveController::class);

Route::get('Invoice_Paid', [InvoicesController::class,'Invoice_Paid'])->name('Invoice_Paid');

Route::get('Invoice_UnPaid', [InvoicesController::class,'Invoice_UnPaid'])->name('Invoice_UnPaid');

Route::get('Invoice_Partial', [InvoicesController::class,'Invoice_Partial'])->name('Invoice_Partial');

Route::get('Print_invoice/{id}', [InvoicesController::class,'Print_invoice'])->name('Print_invoice');

Route::get('export_invoices', [InvoicesController::class, 'export']);

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});


Route::get('invoices_report', [Invoices_Report::class, 'index']);
Route::post('Search_invoices', [Invoices_Report::class, 'Search_invoices']);

// تقارير


Route::get('customers_report' , [Customer_Report::class , 'index'])->name('customers_report');
Route::post('Search_customers', [Customer_Report::class , 'Search_customers']);

Route::get('send-mail', [MailController::class, 'index']);

Route::group(['middleware' => ['CheckStatus']], function () {
    Route::get('/home', ['HomeController@index'])->name('home');

});






//Route::get('/{page}', [AdminController::class, 'index'])->name('home');


Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
