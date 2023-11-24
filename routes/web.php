<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\AddUserController;
use App\Http\Middleware\WebGuard;
use App\Http\Controllers\AddPartyController;
use App\Http\Controllers\TestController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'WebGuard',], function () {

    
    Route::get('/index','IndexController@index');
    
    Route::get('/adduser','AddUserController@AddUser');
    
    Route::post('/adduser','AddUserController@SubmitAddUser');
    
    Route::get('/selectuser','SelectUserController@select');
    
    Route::get('/view/{id}','ViewController@view');
    
    Route::get('/view/api/{user_id}','ViewController@GetTransactionData');
    
    Route::post('/view/submitform','ViewController@SubmitForm');
    
    Route::get('/view/api/delete/{trans_id}','ViewController@DeleteTransactionData');
    
    Route::get('/datewisetransaction','DateController@Date');
    
    Route::post('/date/gettransactiondata','DateController@GetTransactionData');
    
    Route::get('/getpdf/{user_id}','PdfController@generatePDF');
    
    Route::get('/excel/{user_id}','ExcelController@excel');
    
    Route::get('/addparty','AddPartyController@AddParty');
    
    Route::post('/addparty','AddPartyController@SubmitAddParty');
    
    Route::get('/addinvoice','AddInvoiceController@ViewInvoice');
    
    Route::post('/invoice/submitform','AddInvoiceController@SubmitForm');
    
    Route::get('/invoice/delete/{invoice_id}','AddInvoiceController@DeleteInvoice');
    
    Route::get('/invoicereport','InvoiceReportController@viewReport');
    
});


Route::get('/home','DemoController@home');

Route::get('/login','LoginController@login');

Route::post('/login','LoginController@SubmitLogin');

Route::get('/help', function () {
    return view('help');
});

Route::get('/invoice', function () {
    return view('invoice');
});

Route::get('/profile', function () {
    return view('profile');
});

Route::get('/logout', function () {
    session()->forget('email');
    return view('login');
});

Route::get('/session', function () {
    return session()->all();
});

Route::get('/test','TestController@Test');



