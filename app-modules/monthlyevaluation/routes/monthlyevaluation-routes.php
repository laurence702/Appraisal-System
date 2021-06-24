<?php

use Modules\Monthlyevaluation\Http\Controllers\MonthlyEvaluationController;

Route::middleware(['auth:sanctum'])->prefix('api')->group(function () {

    Route::get('/monthlyevaluations', [MonthlyEvaluationController::class, 'index'])->name('monthlyevaluations.index');
    // Route::get('/monthlyevaluations/create', [MonthlyEvaluationController::class, 'create'])->name('monthlyevaluations.create');
    Route::post('/monthlyevaluations', [MonthlyEvaluationController::class, 'store'])->middleware('CanCreateMpe')->name('monthlyevaluations.store');//create KPI
    Route::post('/monthlyevaluations/sub-kpi', [MonthlyEvaluationController::class, 'createSubCategory'])->name('monthlyevaluations.subcategory');
    // Route::get('/monthlyevaluations/{monthlyevaluation}', [MonthlyEvaluationController::class, 'show'])->name('monthlyevaluations.show');
    // Route::get('/monthlyevaluations/{monthlyevaluation}/edit', [MonthlyEvaluationController::class, 'edit'])->name('monthlyevaluations.edit');
    Route::put('/monthlyevaluations/{monthlyevaluation}', [MonthlyEvaluationController::class, 'update'])->name('monthlyevaluations.update');
    Route::delete('/monthlyevaluations/{monthlyevaluation}', [MonthlyEvaluationController::class, 'destroy'])->name('monthlyevaluations.destroy');

    Route::get('/monthlyevaluations/kpi/{employee_id}', [MonthlyEvaluationController::class, 'getEmployeeKPI'])->name('monthlyevaluations.get_kpi');
    Route::get('/monthlyevaluations/eval/{employee_id}', [MonthlyEvaluationController::class, 'getFullEval'])->name('monthlyevaluations.get_eval');
});
Route::fallback(function(){
    return response()->json([
        'status' => false,
        'message' => 'Page Not Found. If error persists, contact it@ukdion.com'], 404);
});

