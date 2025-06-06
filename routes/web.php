<?php

use App\Http\Controllers\Auth\{AdminAuthController};
use App\Http\Controllers\{ProfileController, AdminController, EmployeeController, LeaveController};
use App\Http\Middleware\{RedirectIfAuthenticated};
use Illuminate\Support\Facades\Route;

Route::get('/', [AdminAuthController::class, 'showLoginForm'])->name('login')->middleware([RedirectIfAuthenticated::class . ':guest']);
Route::get('/register', [AdminAuthController::class, 'showRegisterForm'])->name('register')->middleware([RedirectIfAuthenticated::class . ':guest']);
Route::post('_login', [AdminAuthController::class, '_login'])->name('_login');
Route::post('/register', [AdminAuthController::class, 'register']);
Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

Route::prefix('profile')->middleware(['auth'])->group(function () {
    Route::get('', [ProfileController::class, 'profile'])->name('profile')->middleware('auth');
    Route::put('_edit_profile', [ProfileController::class, '_edit_profile'])->name('_edit_profile');
}); 

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('', [AdminController::class, 'index'])->name('index');
    Route::get('tambah_admin', [AdminController::class, 'tambah_admin'])->name('tambah_admin');
    Route::get('edit_admin/{id}', [AdminController::class, 'edit_admin'])->name('edit_admin');
    Route::post('_tambah_admin', [AdminController::class, '_tambah_admin'])->name('_tambah_admin');
    Route::post('_list_admin', [AdminController::class, '_list_admin'])->name('_list_admin');
    Route::put('_edit_admin', [AdminController::class, '_edit_admin'])->name('_edit_admin');
    Route::delete('_delete_admin/{id}', [AdminController::class, '_delete_admin'])->name('_delete_admin');
}); 

Route::prefix('employee')->middleware(['auth'])->group(function () {
    Route::get('', [EmployeeController::class, 'index'])->name('index');
    Route::get('tambah_employee', [EmployeeController::class, 'tambah_employee'])->name('tambah_employee');
    Route::get('edit_employee/{id}', [EmployeeController::class, 'edit_employee'])->name('edit_employee');
    Route::post('_tambah_employee', [EmployeeController::class, '_tambah_employee'])->name('_tambah_employee');
    Route::post('_list_employee', [EmployeeController::class, '_list_employee'])->name('_list_employee');
    Route::put('_edit_employee', [EmployeeController::class, '_edit_employee'])->name('_edit_employee');
    Route::delete('_delete_employee/{id}', [EmployeeController::class, '_delete_employee'])->name('_delete_employee');
});

Route::prefix('leave')->middleware(['auth'])->group(function () {
    Route::get('', [LeaveController::class, 'index'])->name('index');
    Route::get('rekap_cuti', [LeaveController::class, 'rekap_cuti'])->name('rekap_cuti');
    Route::get('tambah_leave', [LeaveController::class, 'tambah_leave'])->name('tambah_leave');
    Route::get('edit_leave/{id}', [LeaveController::class, 'edit_leave'])->name('edit_leave');
    Route::post('_tambah_leave', [LeaveController::class, '_tambah_leave'])->name('_tambah_leave');
    Route::post('_list_leave', [LeaveController::class, '_list_leave'])->name('_list_leave');
    Route::post('_list_employee_leave_summary', [LeaveController::class, '_list_employee_leave_summary'])->name('_list_employee_leave_summary');
    Route::put('_edit_leave', [LeaveController::class, '_edit_leave'])->name('_edit_leave');
    Route::delete('_delete_leave/{id}', [LeaveController::class, '_delete_leave'])->name('_delete_leave');
});