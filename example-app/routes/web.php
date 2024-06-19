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


//routes for blog
Route::get('/', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/post', [BlogController::class, 'post'])->name('blog.post');
Route::post('/blogStore', [BlogController::class, 'store'])->name('blog.store');
Route::get('/blog/edit/{blog}', [BlogController::class, 'edit'])->name('blog.edit');
Route::put('/blog/update/{blog}', [BlogController::class, 'update'])->name('blog.update'); // Changed to POST for AJAX
Route::delete('/blogDelete/{blog}', [BlogController::class, 'destroy'])->name('blog.destroy');
Route::get('/blogTable', [BlogController::class, 'showTable'])->name('blog.show');
Route::put('/blog/Tableupdate/{id}', [BlogController::class, 'updateTable'])->name('blog.updateTable');
