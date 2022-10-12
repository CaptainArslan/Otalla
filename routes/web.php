<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DummyController;
use App\Http\Controllers\Auth\AuthController;
use Faker\Guesser\Name;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Events\Routing;
use Illuminate\Support\Facades\Auth;


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
    return redirect('login');
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
    Route::post('import', [App\Http\Controllers\OrderController::class, 'store'])->name('import');
});


// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// auth routes

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post'); 
Route::get('dashboard', [AuthController::class, 'dashboard'])->middleware('loginMiddleware')->name('dashboard');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');