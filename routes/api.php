<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NoteController;

// Register the notes API routes
Route::apiResource('notes', NoteController::class);