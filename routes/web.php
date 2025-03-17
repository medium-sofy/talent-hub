<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


use App\Http\Controllers\ApplicationController;


// Application routes

Route::middleware('auth')->group(function () {

    Route::get('/employer/applications', [ApplicationController::class, 'empIndex'])->name('applications.emp_index');


    Route::get('/candidate/applications', [ApplicationController::class, 'candIndex'])->name('applications.cand_index');


    Route::resource('applications', ApplicationController::class)->except(['create', 'store']);

    Route::get('/applications/create/{jobId}', [ApplicationController::class, 'create'])->name('applications.create');
    Route::post('/applications/store/{jobId}', [ApplicationController::class, 'store'])->name('applications.store');
});
