<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ArticleController;

Route::post('/login/{role}', [AuthController::class, 'login']);
Route::post('/logout/{role}', [AuthController::class, 'logout']);

Route::middleware(['jwt.admin'])->group(function () {
    Route::post('/news', [AdminController::class, 'createNews']);
    Route::put('/news/{id}', [AdminController::class, 'editNews']);
    Route::delete('/news/{id}', [AdminController::class, 'deleteNews']);
});

Route::middleware(['jwt.user'])->group(function () {
    Route::post('/articles', [ArticleController::class, 'createArticle']);
    Route::delete('/articles/{id}', [ArticleController::class, 'deleteArticle']);
    Route::get('/news', [NewsController::class, 'index']);
    Route::get('/news/{id}', [NewsController::class, 'show']);
    Route::get('/news/{id}/articles', [ArticleController::class, 'getArticlesForNews']);
});