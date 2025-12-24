<?php
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\WeatherController;
use App\Http\Middleware\TrackVisitor;

//lp
// Route::get('/', function () {
//     return view('landingpage');
// });

Route::middleware([TrackVisitor::class])->group(function () {
Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/sejarah', [PageController::class, 'showSejarah'])->name('sejarah.lengkap');

});

// Rute untuk menampilkan form login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Rute untuk memproses data login
Route::post('/login', [AuthController::class, 'login']);

// Rute untuk menampilkan profil pengguna
Route::get('/profile', [PageController::class, 'profile'])
     ->middleware('auth')
     ->name('profile');

// Rute untuk logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute untuk menampilkan form registrasi
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');

// Rute untuk memproses data registrasi
Route::post('/register', [AuthController::class, 'register']);

Route::get('/profil', function () {
    return 'Profil Pengunjung'; // Langsung kirim teks
})->middleware('auth')->name('profil');

// Route::get('/sejarah', function () {
//     return view('sejarah');
// })->name('sejarah.lengkap');

// Route::get('/sejarah', [PageController::class, 'showSejarah'])->name('sejarah.lengkap');

Route::get('/virtual-tour-trunyan', [WeatherController::class, 'showTrunyanWeather']);




