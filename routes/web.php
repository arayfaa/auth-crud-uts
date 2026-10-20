<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    $totalDepartments = Department::count();
    $totalEmployees = Employee::count();
    $totalPayroll = Employee::sum('salary');
    $recentEmployees = Employee::with('department')->latest()->take(5)->get();
    $recentDepartments = Department::withCount('employees')->latest()->take(5)->get();

    return view('dashboard', compact(
        'totalDepartments',
        'totalEmployees',
        'totalPayroll',
        'recentEmployees',
        'recentDepartments'
    ));
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profile bawaan Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // CRUD Departemen dan Pegawai (Dilindungi Middleware Auth)
    Route::resource('departments', DepartmentController::class);
    Route::resource('employees', EmployeeController::class);
});

require __DIR__.'/auth.php';
