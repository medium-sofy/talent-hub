<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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

Route::middleware(['auth'])->group(function () {

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('/admin/job-listings', [AdminController::class, 'jobListings'])->name('admin.jobListings');
    Route::post('/admin/job/{id}/approve', [AdminController::class, 'approveJob'])->name('admin.job.approve');
    Route::post('/admin/job/{id}/reject', [AdminController::class, 'rejectJob'])->name('admin.job.reject');

    Route::get('/admin/applications', [AdminController::class, 'showApplications'])->name('admin.applications');
Route::get('/admin/employers', [AdminController::class, 'showEmployers'])->name('admin.employers');
Route::get('/admin/candidates', [AdminController::class, 'showCandidates'])->name('admin.candidates');

});
require __DIR__.'/auth.php';
