<?php

use Modules\Hr\Http\Controllers\HrController;
use Modules\Hr\Http\Controllers\AccessGateController;

Route::middleware(['auth:sanctum','PermissionGiver'])->prefix('api')->group(function () {
    Route::post('/create-role', [AccessGateController::class, 'createRole'])->name('role.store');
    Route::post('/create-permission', [AccessGateController::class, 'createPermission'])->name('permission.store');
    Route::post('/grant-permission', [AccessGateController::class, 'grantPermission'])->name('permission.grant');
    Route::post('/assignRoleToUser', [AccessGateController::class, 'assignRoleToUser'])->name('role.assignToUser');

    // Route::post('/hrs', [HrController::class, 'store'])->name('hrs.store');
    // Route::get('/hrs/{hr}', [HrController::class, 'show'])->name('hrs.show');
    // Route::get('/hrs/{hr}/edit', [HrController::class, 'edit'])->name('hrs.edit');
    // Route::put('/hrs/{hr}', [HrController::class, 'update'])->name('hrs.update');
    // Route::delete('/hrs/{hr}', [HrController::class, 'destroy'])->name('hrs.destroy');
 });