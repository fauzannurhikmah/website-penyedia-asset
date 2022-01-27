<?php

use App\Http\Controllers\Admin\{AssetController, CategoryController, RenderController, SoftwareController, UserController};
use App\Http\Controllers\{HomeController, UploadController};
use Illuminate\Support\Facades\{Auth, Route};

Route::prefix('category')->group(function () {
    Route::get('/', [CategoryController::class, 'getSeparateData']);
    Route::get('/get', [CategoryController::class, 'getData']);
    Route::post('/create', [CategoryController::class, 'store']);
    Route::delete('/{category:slug}/delete', [CategoryController::class, 'destroy']);
    Route::put('/{category:slug}/update', [CategoryController::class, 'update']);
    Route::get('/{category:slug}/get', [CategoryController::class, 'show']);
});


Route::prefix('software')->group(function () {
    Route::get('/', [SoftwareController::class, 'getSeparateData']);
    Route::get('/get', [SoftwareController::class, 'getData']);
    Route::post('/create', [SoftwareController::class, 'create']);
    Route::delete('/{software:slug}/delete', [SoftwareController::class, 'destroy']);
    Route::put('/{software:slug}/update', [SoftwareController::class, 'update']);
    Route::get('/{software:slug}/get', [SoftwareController::class, 'show']);
});


Route::prefix('render')->group(function () {
    Route::get('/', [RenderController::class, 'getSeparateData']);
    Route::get('/get', [RenderController::class, 'getData']);
    Route::post('/create', [RenderController::class, 'create']);
    Route::delete('/{render:slug}/delete', [RenderController::class, 'destroy']);
    Route::put('/{render:slug}/update', [RenderController::class, 'update']);
    Route::get('/{render:slug}/get', [RenderController::class, 'show']);
});

Route::prefix('user')->group(function () {
    Route::get('/', [UserController::class, 'getData']);
    Route::delete('/{user:username}/delete', [UserController::class, 'destroy']);
});

Route::prefix('asset')->group(function () {
    Route::get('/', [AssetController::class, 'getData']);
    Route::post('/upload', [UploadController::class, 'store']);
    Route::get('/list', [HomeController::class, 'myAssets']);
    Route::delete('/{asset}/delete', [HomeController::class, 'deletMyAssets']);
    Route::get('/{asset:slug}/download', [UploadController::class, 'download']);
});
