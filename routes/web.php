<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PromptController;
use App\Http\Controllers\WeatherRequestController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('home');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('forecast', [WeatherRequestController::class, 'index'])->name('forecastIndex');
Route::post('fetchForecast', [WeatherRequestController::class, 'show'])->name('fetchWeather');


Route::middleware(['auth'])->group(function () {
	Route::get('prompts', [PromptController::class, 'index'])->name('promptIndex');
	Route::get('prompt/create', [PromptController::class, 'create'])->name('promptCreate');
	Route::get('prompt/{prompt}', [PromptController::class, 'update'])->name('promptUpdate');
	Route::post('prompt', [PromptController::class, 'store'])->name('promptStore');
});

Route::middleware(['api_middleware'])->group(function () {
	Route::get('api/v1/prompts', [ApiController::class, 'getPrompts'])->name('getPrompts');
	Route::get('api/v1/forecast-by-coordinates-simple', [ApiController::class, 'forecastByCoordinatesSimple'])->name('forecastByCoordinatesSimple');
	Route::get('api/v1/forecast-by-coordinates-ai', [ApiController::class, 'forecastByCoordinatesAi'])->name('forecastByCoordinatesAi');
});


require __DIR__.'/auth.php';

