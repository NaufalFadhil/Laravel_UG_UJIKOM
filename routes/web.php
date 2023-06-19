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
    return redirect('/employees');
})->name('root');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/employees', [EmployeeController::class, 'index'])->name('employees');
route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');

Route::get('/payroll', [PayrollController::class, 'index'])->name('payroll.index');
Route::post('/payroll', [PayrollController::class, 'store'])->name('payroll.store');

Route::get('/payroll-configuration', [ParameterController::class, 'index'])->name('parameter.index');
Route::post('/payroll-configuration', [ParameterController::class, 'store'])->name('parameter.store');