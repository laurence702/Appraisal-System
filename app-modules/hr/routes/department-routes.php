<?php

use Modules\Hr\Http\Controllers\DepartmentController;

Route::prefix('api')->middleware(['auth:sanctum'])->group(function () {
   Route::get('/departments/bulksave', [DepartmentController::class, 'bulksaveDepts'])->name('departments.bulksave');
   Route::get('/departments', [DepartmentController::class, 'index'])->name('departments.index');
   Route::get('/departments/logout', [DepartmentController::class, 'logout'])->name('departments.logout');
   // Route::get('/departments/create', [DepartmentController::class, 'create'])->name('departments.create');
   // Route::post('/departments', [DepartmentController::class, 'store'])->name('departments.store');
   // Route::get('/departments/{department}', [DepartmentController::class, 'show'])->name('departments.show');
   // Route::get('/departments/{department}/edit', [DepartmentController::class, 'edit'])->name('departments.edit');
   // Route::put('/departments/{department}', [DepartmentController::class, 'update'])->name('departments.update');
   // Route::delete('/departments/{department}', [DepartmentController::class, 'destroy'])->name('departments.destroy');
});
