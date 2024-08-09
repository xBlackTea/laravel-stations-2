<?php

use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\PracticeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SheetController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/practice', [PracticeController::class, 'sample']);
Route::get('/practice2', [PracticeController::class, 'sample2']);
Route::get('/practice3', [PracticeController::class, 'sample3']);
Route::get('/getPractice', [PracticeController::class, 'getPractice']);

Route::get('/sheets', [SheetController::class, 'getSheets']);

Route::get('/movies', [MovieController::class, 'getMovies']);
Route::get('/movies/{id}', [MovieController::class, 'getMovie']);

Route::get('/admin/movies', [MovieController::class, 'adminMovies']);
Route::get('/admin/movies/create', [MovieController::class, 'adminCreateMovies']);
Route::get('/admin/movies/{id}', [MovieController::class, 'adminShowMovie']);
Route::post('/admin/movies/store', [MovieController::class, 'adminStoreMovies']);
Route::get('/admin/movies/{id}/edit', [MovieController::class, 'adminEditMovies']);
Route::patch('/admin/movies/{id}/update', [MovieController::class, 'adminUpdateMovies']);
Route::delete('/admin/movies/{id}/destroy', [MovieController::class, 'adminDestroyMovies']);

Route::get('/admin/schedules', [ScheduleController::class, 'scheduleList']);
Route::get('/admin/schedules/{id}', [ScheduleController::class, 'showSchedule']);
Route::get('/admin/movies/{id}/schedules/create', [ScheduleController::class, 'createSchedule']);
Route::post('/admin/movies/{id}/schedules/store', [ScheduleController::class, 'storeSchedule']);
Route::get('/admin/schedules/{id}/edit', [ScheduleController::class, 'editSchedule']);
Route::patch('/admin/schedules/{id}/update', [ScheduleController::class, 'updateSchedule']);
Route::delete('/admin/schedules/{id}/destroy', [ScheduleController::class, 'destroySchedule']);