<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use Illuminate\Support\Facades\Route;




Route::get('/', [PageController::class, 'welcomePage'])->name('welcome');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'),'verified',])->group(function () {
    Route::get('/dashboard', function () { return view('dashboard');})->name('dashboard');
    Route::resource('user', UserController::class);
    Route::resource('role', RoleController::class);
    Route::resource('permission',PermissionController::class);
    Route::get('role-permission', [PermissionController::class, 'rolePermissions'])->name('role-permission');
    Route::post('sync-permission', [PermissionController::class, 'syncPermissions'])->name('sync-permission');
    
});

