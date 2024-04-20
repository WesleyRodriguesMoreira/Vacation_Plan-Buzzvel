<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
Route::prefix(prefix: 'users')->group(callback: function() {

    Route::get('/user' , [UserController::class, 'index']);

    // Utilizar o "{user}" para manda para a controller
    Route::get('/user/{user}' , [UserController::class, 'show']);
});

