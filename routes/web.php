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

// List
Route::get('/jobs', function () {
    $jobs = Job::with('employer')->latest()->simplePaginate(3);
    return view('Job.index', [
        'jobs' => $jobs
    ]);
});

// create
Route::get('/jobs/create', function () {
    return view('Job.create');
});

// show
Route::get('/jobs/{id}', function ($id) {


    $job = Job::find($id);

    return view('Job.show', ['job' => $job]);
});

// store
Route::post('/jobs', function () {
    // Validation
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required']
    ]);

    Job::create([
        'title' => request('title'),
        'salary' => request('salary'),
        'employer_id' => 1
    ]);

    return redirect('/jobs');
});

// edit
Route::get('/jobs/{id}/edit', function ($id) {


    $job = Job::find($id);

    return view('Job.edit', ['job' => $job]);
});

// Update
Route::patch('/jobs/{id}', function ($id) {
    // validate
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required']
    ]);
    // authorize (on hold)

    $job = Job::findOrFail($id);

    $job->update([
        'title' => request('title'),
        'salary' => request('salary')
    ]);

    return redirect('/jobs/' . $job->id);
});

// delete
Route::delete('/jobs/{id}', function ($id) {
    // authorize

    // delete
    $job = Job::findOrFail($id);
    $job->delete();
    // redirect
    return redirect('/jobs');
});

require __DIR__ . '/auth.php';
