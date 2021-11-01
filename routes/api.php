<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('admin/login', [LoginController::class, 'index'])->name('api.login.index');

Route::get('category', [CategoryController::class, 'index'])->name('api.category.index');
Route::post('category/add', [CategoryController::class, 'doAdd'])->name('api.category.doAdd');
Route::get('category/edit/{id}', [CategoryController::class, 'edit'])->name('api.category.edit');
Route::post('category/edit/{id}', [CategoryController::class, 'doEdit'])->name('api.category.doEdit');
Route::delete('category/delete/{id}', [CategoryController::class, 'delete'])->name('api.category.delete');

Route::get('post', [PostController::class, 'index'])->name('api.post.index');
Route::post('post/add', [PostController::class, 'doAdd'])->name('api.post.doAdd');
Route::get('post/edit/{id}', [PostController::class, 'edit'])->name('api.post.edit');
Route::post('post/edit/{id}', [PostController::class, 'doEdit'])->name('api.post.doEdit');
Route::delete('post/delete/{id}', [PostController::class, 'delete'])->name('api.post.delete');
