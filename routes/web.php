<?php

use App\Http\Controllers\JobListingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\AdminController;

Route::get('/', [JobListingController::class, 'index'])->name('jobs.index');

Route::get('/search', [SearchController::class, 'search'])->name('jobs.search');

Route::get('/home/create', [JobListingController::class, 'create'])->name('jobs.create');
Route::post('/home', [JobListingController::class, 'store'])->name('jobs.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/{slug}', [ProfileController::class, 'showBySlug']) ->name('profile.public');
    Route::get('/profile-edit/', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile-edit', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile-edit', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Application routes
Route::middleware('auth')->group(function () {
    Route::get('/employer/applications', [ApplicationController::class, 'empIndex'])->name('applications.emp_index');
    Route::get('/candidate/applications', [ApplicationController::class, 'candIndex'])->name('applications.cand_index');
    Route::resource('applications', ApplicationController::class)->except(['create', 'store']);
    Route::get('/applications/create/{jobId}', [ApplicationController::class, 'create'])->name('applications.create');
    Route::post('/applications/store/{jobId}', [ApplicationController::class, 'store'])->name('applications.store');
});

// Notification routes
Route::middleware(['auth'])->group(function () {
    Route::post('/notifications/{id}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::post('/notifications/{id}/mark-as-unread', [NotificationController::class, 'markAsUnread'])->name('notifications.markAsUnread');
    Route::post('/notifications/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
});

// Admin routes
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