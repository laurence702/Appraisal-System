<?php

use Modules\Hr\Http\Controllers\DesignationController;

Route::prefix('api')->middleware(['auth:sanctum'])->group(function () {
   Route::get('/designations', [DesignationController::class, 'index'])->name('designations.index');
   Route::get('/designations/create', [DesignationController::class, 'create'])->name('designations.create');
   Route::get('/designations/bulksave', [DesignationController::class, 'bulksaveDesignations'])->name('designations.bulksave');
   // Route::post('/designations', [DesignationController::class, 'store'])->name('designations.store');
   // Route::get('/designations/{employee}', [DesignationController::class, 'show'])->name('designations.show');
   // Route::get('/designations/{employee}/edit', [DesignationController::class, 'edit'])->name('designations.edit');
   // Route::put('/designations/{employee}', [DesignationController::class, 'update'])->name('designations.update');
   // Route::delete('/designations/{employee}', [DesignationController::class, 'destroy'])->name('designations.destroy');
});