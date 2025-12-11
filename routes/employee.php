<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Employee\EmployeeController;

Route::middleware(['auth','role:employee'])->prefix('employee')->group(function(){
    Route::get('/dashboard', [EmployeeController::class, 'dashboard'])->name('employee.dashboard');
});
