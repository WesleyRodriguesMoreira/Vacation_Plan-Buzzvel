<?php
use App\Http\Controllers\ContaController;
use App\Http\Controllers\VacationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
|  Here is recorded all the routes from the web to the API.
|  These routes are loaded by the RouteServiceProvider and all of them will be assigned to the "web" middleware group.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/create-vacation', [VacationController::class, 'create'])->name('vacation.create');
Route::post('/store-vacation', [VacationController::class, 'store'])->name('vacation.store');

Route::get('/index-vacation', [VacationController::class, 'index'])->name('vacation.index');
Route::get('/show-vacation/{vacation}', [VacationController::class, 'show'])->name('vacation.show');

Route::get('/edit-vacation/{vacation}', [VacationController::class, 'edit'])->name('vacation.edit');
Route::put('/update-conta/{conta}', [ContaController::class, 'update'])->name('conta.update');

Route::delete('/vacation-conta/{vacation}', [ContaController::class, 'destroy'])->name('vacation.destroy');

Route::get('/gerar-pdf-conta', [ContaController::class, 'gerarPdf'])->name('conta.gerar-pdf');



// Route::get('/change-situation-conta/{conta}', [ContaController::class, 'changeSituation'])->name('conta.change-situation');
// Route::get('/gerar-csv-conta', [ContaController::class, 'gerarCsv'])->name('conta.gerar-csv');
// Route::get('/gerar-word-conta', [ContaController::class, 'gerarWord'])->name('conta.gerar-word');