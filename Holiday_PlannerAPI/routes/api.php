<?php
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

    Route::get('/user' , [UserController::class, 'index']);

    // Utilizar o "{user}" para manda para a controller
    Route::get('/user/{user}' , [UserController::class, 'show']);
    
    Route::post('/store' , [UserController::class, 'store']);

    // Utilizar o "{user}" para manda para a controller
    Route::get('/update/{user}' , [UserController::class, 'update']);






