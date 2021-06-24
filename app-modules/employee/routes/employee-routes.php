<?php


 use Modules\Employee\Http\Controllers\EmployeeController;

 Route::prefix('api')->group(function () {
    Route::post('employees/login', [EmployeeController::class, 'login'])->name('employees.login');
    Route::get('fetchEmployees', [EmployeeController::class, 'getEmployees'])->name('getEmployees');
 });
 
 Route::get('/test-slack', function () {
    //throw new Exception('Exception is thrown');
    \Log::critical('This is a critical message Sent from Laravel App');
      throw new Exception("I threw a custom error");
      
  });

 Route::middleware('auth:sanctum')->prefix('api')->group(function () {
    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
    Route::get('/employee/logout', [EmployeeController::class, 'logout'])->name('employee.logout');
    Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
    Route::get('/exmployees/{employee}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
    Route::put('/employees/{employee}', [EmployeeController::class, 'update'])->name('employees.update');
    Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy'])->name('employees.destroy');
    //Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
    // Route::get('/employees/{employee}', [EmployeeController::class, 'show'])->name('employees.show');
   });
   Route::get('/employees/gofetchfromerp', [EmployeeController::class, 'bulkSaveEmployees'])->name('employees.bulksave');

   Route::get('testZeroBounceApi',[EmployeeController::class, 'testZeroBounceApi']);