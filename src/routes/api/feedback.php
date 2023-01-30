<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use Backpack\Feedback\app\Http\Controllers\Api\FeedbackController;

Route::prefix('api/feedback')->controller(FeedbackController::class)->group(function () {
  Route::post('', 'create')->middleware('api');
});
