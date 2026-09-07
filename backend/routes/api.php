<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\LanguageController;
use App\Http\Controllers\Api\V1\DialectController;
use App\Http\Controllers\Api\V1\ContributionController;
use App\Http\Controllers\Api\V1\ReviewController;
use App\Http\Controllers\Api\V1\CourseController;
use App\Http\Controllers\Api\V1\ExportController;
use App\Http\Controllers\Api\V1\AiController;
use App\Http\Controllers\Api\V1\DictionaryController;
use App\Http\Controllers\Api\V1\SourceController;
use App\Http\Controllers\Api\V1\AudioController;
use App\Http\Controllers\Api\V1\CommunityController;

Route::prefix('v1')->group(function () {
    Route::apiResource('languages', LanguageController::class)->only(['index', 'show']);
    Route::get('languages/{language}/dialects', [DialectController::class, 'index']);
    Route::get('contributions', [ContributionController::class, 'index']);
    Route::get('contributions/{contribution}', [ContributionController::class, 'show']);
    Route::get('sources', [SourceController::class, 'index']);
    Route::get('audio', [AudioController::class, 'index']);
    Route::get('community/posts', [CommunityController::class, 'posts']);
    Route::get('reviews', [ReviewController::class, 'index']);
    Route::get('courses', [CourseController::class, 'index']);
    Route::get('dictionary', [DictionaryController::class, 'index']);
    Route::get('dictionary/{lexicalEntry}', [DictionaryController::class, 'show']);
    Route::get('exports/languages', ExportController::class);
    Route::post('ai/query', AiController::class);
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('languages', [LanguageController::class, 'store']);
        Route::post('dialects', [DialectController::class, 'store']);
        Route::post('contributions', [ContributionController::class, 'store']);
        Route::post('contributions/{contribution}/submit', [ContributionController::class, 'submit']);
        Route::post('contributions/{contribution}/publish', [ContributionController::class, 'publish']);
        Route::post('reviews', [ReviewController::class, 'store']);
        Route::post('dictionary', [DictionaryController::class, 'store']);
        Route::post('sources', [SourceController::class, 'store']);
        Route::post('audio', [AudioController::class, 'store']);
        Route::post('community/posts', [CommunityController::class, 'storePost']);
        Route::post('community/posts/{post}/comments', [CommunityController::class, 'comment']);
        Route::post('community/reports', [CommunityController::class, 'report']);
    });
});
