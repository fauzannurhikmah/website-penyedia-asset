<?php

use App\Http\Controllers\Admin\{AssetController, CategoryController, DashboardController, RenderController, SoftwareController, UserController};
use App\Http\Controllers\{HomeController, UploadController};
use Illuminate\Support\Facades\{Auth, Route};

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/assets', [HomeController::class, 'allShow'])->name('all-asset');
Route::get('/asset/{asset:slug}/detail', [HomeController::class, 'show'])->name('detail-asset');
Route::get('/assets/{category:slug}/category', [HomeController::class, 'byCategory'])->name('by-category');
Route::get('/categories', [HomeController::class, 'category'])->name('categories');

Route::middleware('auth')->group(function () {
    Route::view('/asset/upload', 'upload-asset')->name('upload-asset');
    Route::get('/asset/{asset:slug}/download', [UploadController::class, 'download'])->name('download-asset');
    Route::prefix('profile')->group(function () {
        Route::view('/', 'profile')->name('profile');
        Route::get('/download', [HomeController::class, 'listDownload'])->name('download-history');
        Route::view('/subcription', 'subcription')->name('subcription')->withoutMiddleware('auth');
        Route::get('/upload-list', [HomeController::class, 'listUpload'])->name('upload-list');
    });
});

Auth::routes();
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::get('/category', [CategoryController::class, 'index'])->name('category');
    Route::get('/user', [UserController::class, 'index'])->name('users');
    Route::get('/asset', [AssetController::class, 'index'])->name('assets');
    Route::get('/asset/{asset:slug}/detail', [AssetController::class, 'show'])->name('asset-detail');
    Route::get('/software', [SoftwareController::class, 'index'])->name('software');
    Route::get('/render', [RenderController::class, 'index'])->name('render');
    Route::get('/user/{user}/detail', [UserController::class, 'show'])->name('user-detail');
});
