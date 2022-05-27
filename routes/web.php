<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DeptController;
use App\Http\Controllers\SendEmailController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', function(){
    return view('auth.register');
})->name('register');

Route::middleware(['middleware' => 'auth'])->group(function () {
/*Route::group(['middleware' => 'auth'], function(){*/
    Route::get('/dashboard', function () {
        return view('dashboard');
    });
    //form routes
    Route::get('/forms/{deptId}', [FormController::class, 'index']);
    Route::get('/forms', [FormController::class, 'index'])->middleware(['auth']);
    Route::get('/form/{fid}', [FormController::class, 'show']);
    Route::get('/form/{form}/edit', [FormController::class, 'edit'])->name('form-edit');
    Route::patch('/form/{fid}', [FormController::class, 'update'])->name('form-update');
    Route::get('/form/create', [FormController::class, 'create']);
    Route::post('/form/{fid}', [FormController::class, 'store']);    
    
    //submission routes
    Route::post('/submission/save', [SubmissionController::class, 'store']);
    Route::get('/submission/{sid}', [SubmissionController::class, 'show']);
    Route::group(['middleware' => 'role_or_permission:admin|submission-edit'], function(){
         Route::get('/submission/{sid}/edit', [SubmissionController::class, 'edit']);
    });
    Route::get('/submissions', [SubmissionController::class, 'index'])->name('requisitions');   
    Route::get('/submission/create/{fid}', [SubmissionController::class, 'create'])->name('submission.create');
    Route::patch('/submission/{sid}/update', [SubmissionController::class, 'update']);
    Route::post('/submission/{sid}', [SubmissionController::class, 'sendMail'])->name('sendpdf');
    
    //users and roles
    Route::get('users/list', [UserController::class, 'index']);    
    
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
   
   //dept routes
   Route::get('/depts', [DeptController::class, 'index'])->name('depts');    
});


Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'Application Cache Cleared. Application Config Cleared. Return <a href="/" title="home">Home</a>.'; //return anything
});

/*
 TODO: implement an admin dashboard
 Route::get('/admin', function()
{
    return view('admin.index');
})->middleware(['auth', 'role:Admin'])->name('admin.index');
*/

require __DIR__.'/auth.php';
