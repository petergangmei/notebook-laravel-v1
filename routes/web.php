<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;

Route::redirect('/', '/notes');
Route::resource('notes', NoteController::class);
