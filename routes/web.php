<?php

use App\Http\Controllers\ParameterController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

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
    return redirect('/employee');
})->name('root');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::post('/payroll/export', [PayrollController::class, 'export'])->name('payroll.export');

Route::resource('employee', EmployeeController::class);
Route::resource('payroll', PayrollController::class);
Route::resource('payroll-configuration', ParameterController::class);