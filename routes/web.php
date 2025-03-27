<?php

use App\Http\Controllers\JobListingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

Route::get('/', [JobListingController::class, 'index'])->name('jobs.index');

Route::get('/search', [SearchController::class, 'search'])->name('jobs.search');

Route::get('/jobs/create', [JobListingController::class, 'create'])->name('jobs.create');
Route::post('/jobs', [JobListingController::class, 'store'])->name('jobs.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
