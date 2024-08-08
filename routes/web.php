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
use App\Http\Controllers\SheetController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('practice', function() {
//     return response('practice');
// });

// Route::get('practice2', function() {
//     $test = 'practice2';
// return response($test);
// });

// Route::get('practice3', function() {
//     $test = 'test';
// return response($test);
// });

Route::get('/practice', [PracticeController::class, 'sample']);
Route::get('/practice2', [PracticeController::class, 'sample2']);
Route::get('/practice3', [PracticeController::class, 'sample3']);
Route::get('/getPractice', [PracticeController::class, 'getPractice']);

Route::get('/movies', [MovieController::class, 'getMovies']);
Route::get('/movies/{id}', [MovieController::class, 'show']);

Route::get('/sheets', [SheetController::class, 'getSheets']);

Route::get('/admin/movies', [MovieController::class, 'getAdminMovies']);

Route::get('/admin/movies/create', [MovieController::class, 'create']);
Route::post('/admin/movies/store', [MovieController::class, 'store']);

Route::get('/admin/movies/{id}/edit', [MovieController::class, 'edit']);
Route::patch('/admin/movies/{id}/update', [MovieController::class, 'update']);

Route::delete('/admin/movies/{id}/destroy', [MovieController::class, 'destroy']);