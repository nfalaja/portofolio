<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProjectController;
use Illuminate\Auth\Events\Login;
use Psy\TabCompletion\Matcher\FunctionsMatcher;

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
    return redirect('/login');
});
// admin
Route::middleware('auth')->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');
    Route::get('/mastersiswa/{id_siswa}/hapus', [SiswaController::class, 'hapus'])->name('mastersiswa.hapus');
    Route::get('/masterproject/{id_siswa}/hapus', [ProjectController::class, 'hapus'])->name('masterproject.hapus');
    Route::resource('/mastersiswa', SiswaController::class);
    Route::resource('/masterproject', ProjectController::class);
    Route::resource('/masterkontak', KontakController::class);
});

Route::middleware('guest')->group(function(){
    Route::get('/', function () {return view('login');});
    Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
    Route::get('/register', [LoginController::class, 'register'])->name('register');


});
Route::post('/register/masuk', [LoginController::class, 'store'])->name('login.store');
Route::post('/login/login', [LoginController::class, 'authenticate'])->name('login.in');

// Guest






// Route::get('/about', function () {
//     return view('about');
// });

// Route::get('/project', function () {
//     return view('project');
// });

// Route::get('/dashboard', function () {
//     return view('admin.Dashboard');
// });

// Route::get('/contact', function () {
//     return view('contact');
// });

// Route::get('/parent', function () {
//     return view('parent');
// });

// Route::get('/mastersiswa', function () {
//     return view('admin.MasterSiswa');
// });

// Route::get('/masterproject', function () {
//     return view('admin.MasterProject');
// });

// Route::get('/masterkontak', function () {
//     return view('admin.MasterKontak');
// });
