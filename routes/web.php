<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\CKEditorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CalendarController;
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
    return view('welcome');
});

// Route::get('/temp', [LoginController::class, 'temp'])->name('admin.login.temp');
Route::get('admin/login', [LoginController::class, 'index'])->name('admin.login.index');
Route::post('admin/login', [LoginController::class, 'doLogin'])->name('admin.login.doLogin');
Route::get('admin/logout', [LoginController::class, 'logout'])->name('admin.login.logout');

Route::post('ckeditor/upload', [CKEditorController::class, 'upload'])->middleware('auth.admin')->name('ckeditor.image-upload');

Route::prefix('admin')->middleware('auth.admin')->group(function () {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');

    Route::get('category', [CategoryController::class, 'index'])->name('admin.category.index');
    Route::get('category/add', [CategoryController::class, 'add'])->name('admin.category.add');
    Route::post('category/add', [CategoryController::class, 'doAdd'])->name('admin.category.doAdd');
    Route::get('category/edit/{id}', [CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::post('category/edit/{id}', [CategoryController::class, 'doEdit'])->name('admin.category.doEdit');
    Route::get('category/delete/{id}', [CategoryController::class, 'delete'])->name('admin.category.delete');

    Route::get('category/children/{id}', [CategoryController::class, 'children'])->name('admin.category.children');

    Route::get('post', [PostController::class, 'index'])->name('admin.post.index');
    Route::get('post/add', [PostController::class, 'add'])->name('admin.post.add');
    Route::post('post/add', [PostController::class, 'doAdd'])->name('admin.post.doAdd');
    Route::get('post/edit/{id}', [PostController::class, 'edit'])->name('admin.post.edit');
    Route::post('post/edit/{id}', [PostController::class, 'doEdit'])->name('admin.post.doEdit');
    Route::get('post/delete/{id}', [PostController::class, 'delete'])->name('admin.post.delete');
});

Route::get('/', [HomeController::class, 'index'])->name('admin.home.index');
Route::get('/post/{id}-{slug}', [HomeController::class, 'detailPost'])->name('admin.detail-post.index');
Route::get('/about', [HomeController::class, 'about'])->name('admin.about.index');
Route::get('/calendar', [CalendarController::class, 'index'])->name('front.calendar.index');

