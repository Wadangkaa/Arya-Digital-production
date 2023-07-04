<?php

use App\Models\Feature;
use App\Models\Service;
use App\Models\Portfolio;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PortfolioController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
//show blog management
Route::get('/manage/blogs', [BlogController::class,'index']);
//events management
Route::get('/manage/events', [EventController::class, 'index']);
//portfolio management
Route::get('/manage/portfolios', [PortfolioController::class,'index']);
// features management
Route::get('/manage/features', [FeatureController::class,'index']);
//services management
Route::get('/manage/services',[ServiceController::class, 'index']);

//open blog create page
Route::get('/blog/create', [BlogController::class,'create']);
//store blog post
Route::post('/blogs', [BlogController::class,'store']);
//open edit blog
Route::get('/blog/{blog}/edit', [BlogController::class,'edit']);
//update edited blog
Route::put('/blog/{blog}', [BlogController::class,'update']);
//delete  blog
Route::delete('/blog/{blog}', [BlogController::class,'destroy']);

//open event create page
Route::get('/event/create', [EventController::class,'create']);
//store event post
Route::post('/events', [EventController::class,'store']);
//open edit event
Route::get('/event/{event}/edit', [EventController::class,'edit']);
//update edited event
Route::put('/event/{event}', [EventController::class,'update']);
//delete  event
Route::delete('/event/{event}', [EventController::class,'destroy']);

//open feature create page
Route::get('/feature/create', [FeatureController::class,'create']);
//store feature post
Route::post('/features', [FeatureController::class,'store']);
//open edit feature
Route::get('/feature/{feature}/edit', [FeatureController::class,'edit']);
//update edited feature
Route::put('/feature/{feature}', [FeatureController::class,'update']);
//delete  feature
Route::delete('/feature/{feature}', [FeatureController::class,'destroy']);

//open portfolio create page
Route::get('/portfolio/create', [PortfolioController::class,'create']);
//store portfolio post
Route::post('/portfolios', [PortfolioController::class,'store']);
//open edit portfolio
Route::get('/portfolio/{portfolio}/edit', [PortfolioController::class,'edit']);
//update edited portfolio
Route::put('/portfolio/{portfolio}', [PortfolioController::class,'update']);
//delete  portfolio
Route::delete('/portfolio/{portfolio}', [PortfolioController::class,'destroy']);

//open service create page
Route::get('/service/create', [ServiceController::class,'create']);
//store service post
Route::post('/services', [ServiceController::class,'store']);
//open edit service
Route::get('/service/{service}/edit', [ServiceController::class,'edit']);
//update edited service
Route::put('/service/{service}', [ServiceController::class,'update']);
//delete  service
Route::delete('/service/{service}', [ServiceController::class,'destroy']);
require __DIR__.'/auth.php';
