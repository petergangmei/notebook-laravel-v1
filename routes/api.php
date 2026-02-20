<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NoteController;

// Custom POST-only note endpoints
Route::post('notes/create', [NoteController::class, 'create']);
Route::post('notes/update', [NoteController::class, 'update']);
Route::post('notes/delete', [NoteController::class, 'delete']);
Route::post('notes/list', [NoteController::class, 'list']);
Route::post('notes/detail', [NoteController::class, 'detail']);