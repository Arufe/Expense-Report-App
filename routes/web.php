<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExpenseReportController;
use App\Http\Controllers\ExpenseController;

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


Route::get('/', [\App\Http\Controllers\HomeController::class, 'index']);


Route::resource('/expense_reports', ExpenseReportController::class);


Route::get('/expense_reports/{id}/confirmDelete', [ExpenseReportController::class, 'confirmDelete']);


Route::get('/expense_reports/{expense_report}/expenses/create', [ExpenseController::class, 'create']);


Route::post('/expense_reports/{expense_report}/expenses', [ExpenseController::class, 'store']);


Route::get('/expense_reports/{id}/confirmSendMail', [ExpenseReportController::class, 'confirmSendMail']);


Route::post('/expense_reports/{id}/sendMail', [ExpenseReportController::class, 'sendMail']);


 Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'home']);
// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
