<?php

use App\Http\Controllers\BlogController;
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

Route::get('/', function () {
    return view('home');
});

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/post', [BlogController::class, 'post'])->name('blog.post');
Route::post('/blog', [BlogController::class, 'store'])->name('blog.store');
Route::get('/blog/{blog}/edit', [BlogController::class, 'edit'])->name('blog.edit');
Route::put('/blog/{blog}/update', [BlogController::class, 'update'])->name('blog.update');
Route::delete('/delete/{blog}', [BlogController::class, 'destroy'])->name('blog.destroy');