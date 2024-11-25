<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ArticleController;

// Admin routes (requires admin authentication)
Route::middleware(['auth:admin'])->group(function () {
    Route::post('/news', [AdminController::class, 'createNews']);
    Route::put('/news/{id}', [AdminController::class, 'editNews']);
    Route::delete('/news/{id}', [AdminController::class, 'deleteNews']);
});

// User routes (requires user authentication)
Route::middleware(['auth:web'])->group(function () {
    Route::post('/articles', [ArticleController::class, 'createArticle']);
    Route::delete('/articles/{id}', [ArticleController::class, 'deleteArticle']);
    Route::get('/news', [NewsController::class, 'index']);
    Route::get('/news/{id}', [NewsController::class, 'show']);
    Route::get('/news/{id}/articles', [ArticleController::class, 'getArticlesForNews']);
});