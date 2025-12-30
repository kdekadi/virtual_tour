<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\WeatherController;
use App\Http\Middleware\TrackVisitor;

//Rute ane di Miidleware
Route::middleware([TrackVisitor::class])->group(function () {
Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/sejarah', [PageController::class, 'showSejarah'])->name('sejarah.lengkap');

});

// Rute form login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Rute memproses data login
Route::post('/login', [AuthController::class, 'login']);

// Rute profil 
Route::get('/profile', [PageController::class, 'profile'])
     ->middleware('auth')
     ->name('profile');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');

Route::post('/register', [AuthController::class, 'register']);

Route::get('/profil', [PageController::class, 'profil'])
    ->middleware('auth')
    ->name('profil');

Route::middleware('auth')->group(function () {
    Route::get('/profil/edit', [PageController::class, 'edit'])
        ->name('edit_profil');

    Route::post('/profil/update', [PageController::class, 'update'])
        ->name('profil.update');
});


Route::get('/virtual-tour-trunyan', [WeatherController::class, 'showTrunyanWeather']);




