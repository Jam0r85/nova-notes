<?php

use Illuminate\Support\Facades\Route;
use Jam0r85\NovaNotes\NoteController;

/*
|--------------------------------------------------------------------------
| Tool API Routes
|--------------------------------------------------------------------------
|
| Here is where you may register API routes for your tool. These routes
| are loaded by the ServiceProvider of your tool. You're free to add
| as many additional routes to this file as your tool may require.
|
*/

Route::post('/notes', NoteController::class.'@index');
Route::get('/important', NoteController::class.'@important');
Route::post('/new-note', NoteController::class.'@store');
