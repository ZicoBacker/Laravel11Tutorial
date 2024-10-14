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
    $jobs = Job::with('employer')->latest()->simplePaginate(3);
    return view('Job.index', [
        'jobs' => $jobs
    ]);
});

Route::get('/jobs/create', function () {
    return view('Job.create');
});

Route::get('/jobs/{id}', function ($id) {


    $job = Job::find($id);

    return view('Job.show', ['job' => $job]);
});

Route::post('/jobs', function () {
    // Validation

    Job::create([
        'title' => request('title'),
        'salary' => request('Salary'),
        'employer_id' => 1
    ]);

    return redirect('/jobs');
});

require __DIR__ . '/auth.php';
