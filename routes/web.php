<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PublicGetDataController;
use App\Http\Controllers\QRCodeController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard-index');
});
Route::get('phpinfo', fn () => phpinfo());

Route::prefix('/app/bmn')->group(function (){
    /**
     * * Authentication Route
     */
    Route::get('login', [LoginController::class, 'index'])->middleware('guest')->name('login')->middleware('guest');
    Route::post('login', [LoginController::class, 'authenticate'])->name('login-submit');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('forgot-password', [ForgotPasswordController::class, 'forgot_password'])->middleware('guest')->name('forgot-password');
    Route::post('forgot-password-submit', [ForgotPasswordController::class, 'forgot_password_submit'])->name('forgot-password-submit');

    Route::get('reset-password/{token}', [ResetPasswordController::class, 'reset_password'])->middleware('guest')->name('password.reset');
    Route::post('reset-password/', [ResetPasswordController::class, 'reset_password_submit'])->middleware('guest')->name('password.update');

    /**
     * * Controller for Dashboard
     */
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard-index')->middleware('auth');
    
    /**
     * * Controller for export excel
     */
    Route::post('barangs/export', [ExportController::class, 'export'])->name('export.excel');
    
    /**
     * * Controller for fetching data to public 
     */
    Route::get('get-data/{id}', [PublicGetDataController::class, 'index'])->name('public.get.data');

    /** 
     * * Barang Route
     */
    Route::resource('barang', BarangController::class)->middleware('auth')->names([
        'index' => 'barang-index',
        'create' => 'barang-create',
        'store' => 'barang-create-submit',
        'edit' => 'barang-edit',
        'update' => 'barang-edit-submit',
        'destroy' => 'barang-delete',
        'show' => 'barang-show',
    ]);

    /** 
     * * QR Code Route
     */
    Route::get('qr-code', [QRCodeController::class, 'index'])->name('qrcode-index');
    Route::post('generate-qrcode', [QRCodeController::class, 'generateQR'])->middleware('auth')->name('qrcode-generate');

    /**
     * * User Route
     */
    Route::resource('users', UserController::class)->middleware(['auth', 'admin'])->names([
        'index' => 'user-index',
        'create' => 'user-create',
        'store' => 'user-create-submit',
        'edit' => 'user-edit',
        'update' => 'user-edit-submit',
        'destroy' => 'user-delete',
    ])->except('show');

    /**
     * * Role Route
     */
    Route::resource('roles', RoleController::class)->middleware('superadmin')->names([
        'index' => 'role-index',
        'create' => 'role-create',
        'store' => 'role-create-submit',
        'edit' => 'role-edit',
        'update' => 'role-edit-submit',
        'destroy' => 'role-delete',
    ])->except('show');
});