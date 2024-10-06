<?php

use App\Http\Controllers\API\ArticleController;
use Illuminate\Support\Facades\Route;


Route::prefix('articles')->controller(ArticleController::class)->group(function () {
    Route::get('/', 'index');
});
