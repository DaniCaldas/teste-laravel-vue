<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredCompanyController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LoginController;
use App\Http\Middleware\CompanyAuth;
use App\Http\Middleware\HandleInertiaRequests;
use App\Models\Company;

Route::get('/login', fn() => inertia('Login/Login'))->name('index');
Route::get('/login', fn() => inertia('Login/Login'))->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::get('/register',  fn() => inertia('Register/Index'))->name('register');
Route::post('/register', [CompanyController::class, 'store']);
Route::post('/logoff', [LoginController::class, 'logoff'])->name('logoff');

Route::get('/dashboard', fn() => inertia('Dashboard/Index'))->name('dashboard')->middleware(CompanyAuth::class);
Route::middleware(CompanyAuth::class)->group(function () {
    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees');
    Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
    Route::put('/employees/{id}', [EmployeeController::class, 'update'])->name('employees.update');
    Route::put('/employees', [EmployeeController::class, 'destroy'])->name('employees.destroy');
});