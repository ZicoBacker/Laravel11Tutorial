<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use \Illuminate\Support\Arr;
use App\Models\Job;




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

Route::get('/about', function () {
    return view('about', [
        'greetings' => 'hello'
    ]);
});

Route::get('/info', function () {
    return view('info');
});

Route::get('/jobs', function () {
    return view('jobs', [
        'jobs' => Job::all()
    ]);
});

Route::get('/jobs/{id}', function ($id) {


    $job = Job::find($id);

    return view('job ', ['job' => $job]);
});
require __DIR__ . '/auth.php';
