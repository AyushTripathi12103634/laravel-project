<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\MyController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CandidateController;

Route::get('/', function () {
    return view('layout', ['view' => 'home']);
})->name('home');

Route::get('/login', function (Request $request) {
    if ($request->session()->get('isLogin')) {
        return redirect('/');
    }
    return view('layout', ['view' => 'auth.login']);
})->name('auth.login');

Route::get('/register', function (Request $request) {
    if ($request->session()->get('isLogin')) {
        return redirect('/');
    }
    return view('layout', ['view' => 'auth.register']);
})->name('auth.register');

Route::get('/admin/login', function (Request $request) {
    if ($request->session()->get('isLogin')) {
        return redirect('/');
    }
    return view('layout', ['view' => 'admin.login']);
})->name('admin.login');

Route::get('/response', [MyController::class, 'showResponse'])->name('response.show');

Route::get('/admin/profile', [AdminController::class, 'showProfile'])->name('admin.profile');
Route::post('/admin/profile/verify/{id}', [AdminController::class, 'verifyJob'])->name('admin.profile.verify');

Route::get('/employers/create-job', function () {
    return view('layout', ['view' => 'employers.create-job']);
})->name('employers.create-job');

Route::get('/employers/jobs', [EmployerController::class, 'index'])->name('employers.jobs');
Route::get('/employers/jobs/applicants/{jobId}', [EmployerController::class, 'showApplicants'])->name('employers.jobs.applicants');
Route::delete('/employers/jobs/delete/{id}', [EmployerController::class, 'delete'])->name('employers.jobs.delete');
Route::post('/create-job', [EmployerController::class, 'createJob']);

Route::get('/candidates/applied-jobs', [CandidateController::class, 'appliedJobs'])->name('candidates.applied-jobs');
Route::get('/candidates/jobs', [CandidateController::class, 'allJobs'])->name('candidates.jobs');
Route::post('/apply-job/{id}', [CandidateController::class, 'applyForJob'])->name('apply.for.job');
Route::delete('/candidates/jobs/unapply/{jobId}', [CandidateController::class, 'unapplyJob'])->name('unapply.job');

Route::post('/toggle-theme', function (Request $request) {
    $request->session()->put('darkMode', $request->theme === 'dark');
    return response()->json(['success' => true]);
});

Route::post('/register-function', [AuthController::class, 'register']);
Route::post('/login-function', [AuthController::class, 'login']);
Route::post('/admin-login-function', [AuthController::class, 'adminLogin']);
Route::post('/logout', function (Request $request) {
    $request->session()->flush();
    return redirect('/');
})->name('logout');
