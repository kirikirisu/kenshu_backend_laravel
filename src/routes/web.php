<?php declare(strict_types=1);

use App\Http\Controllers\CreatePostController;
use App\Http\Controllers\GetTopPageController;
use App\Http\Controllers\LoginUserController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\UpdatePostController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', GetTopPageController::class);

Route::get('/register', function () {
    return view('register');
});

Route::post('/register', RegisterUserController::class);

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', LoginUserController::class);

Route::post('/posts', CreatePostController::class)->middleware('auth');

Route::patch('/posts', UpdatePostController::class)->middleware('auth');
