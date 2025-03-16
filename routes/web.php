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
Route::get('/profil', function () {
    $users =
        [
            'name' => 'Amr Ahmedd',
            'email' => 'amroa333@gmail.com',
            'role' => 'candidate',
            'jobTitle' => 'web developer',
            'About' => 'I am a web developer',
            'skills' => 'php, laravel, javascript, html, css',
            'experience' => '2 years',
            'education' => 'bachelor of computer science',
    'phone' => '01000000000',
    'linkedin'=>'https://www.linkedin.com/in/amroa333/',
        ];

    return view('profile.index',compact('users'));
});


require __DIR__.'/auth.php';

