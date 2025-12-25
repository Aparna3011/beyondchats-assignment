<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;

//Fetch scraped articles
Route::get('/articles/original', [ArticleController::class, 'original']);
//  Save AI enriched articles
Route::post('/articles/enriched', [ArticleController::class, 'storeEnriched']);

Route::get('/articles/enriched', [ArticleController::class, 'enriched']);
