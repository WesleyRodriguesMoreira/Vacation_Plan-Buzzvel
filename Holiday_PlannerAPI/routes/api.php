<?php
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

    Route::get('/user' , [UserController::class, 'index']);

    // Utilizar o "{user}" para manda para a controller
    Route::get('/user/{user}' , [UserController::class, 'show']);
    
    Route::post('/store' , [UserController::class, 'store']);

    // Utilizar o "{user}" para manda para a controller
    Route::get('/update/{user}' , [UserController::class, 'update']);

    // Utilizar o "{user}" para manda para a controller
    Route::get('/destroy/{user}' , [UserController::class, 'destroy']);

    // Utilizar o "{user}" para manda para a controller
    // Route::get('/destroy_log/{user}' , [UserController::class, 'destroy_log']);






