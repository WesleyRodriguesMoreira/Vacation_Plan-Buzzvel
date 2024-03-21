<?php

namespace App\Http\Controllers;

use App\Http\Requests\VacationRequest;
use App\Models\Vacation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VacationController extends Controller
{
     // === Plan Registration Form ===
     public function create()
     {
         // // Recuperar do banco de dados as situações
         // $situacoesContas = SituacaoConta::orderBy('nome', 'asc')->get();
 
         // Load the VIEW
         return view('vacation.create'
         // , ['situacoesContas' => $situacoesContas,]
     );
     }
 
 
     // === Register vacation plans in the database ===
     public function store(VacationRequest $request)
     {
         // Validate the form
         $request->validated();
 
         try {
 
             // Cadastrar no banco de dados na tabela contas os valores de todos os campos
             $vacation = Vacation::create([
                 'title' => $request->title,
                 'local' => $request->local,
                 'description' => $request->description,
                 'date' => $request->date,
             ]);
 
             // Redirecionar o usuário, enviar a mensagem de sucesso
             return redirect()->route('vacation.show', ['vacation' => $vacation->id])->with('success', 'Vacation plan successfully registered');
         } catch (Exception $e) {
 
             // Salvar log
             Log::warning('Conta não cadastrada', ['error' => $e->getMessage()]);
 
             // Redirecionar o usuário, enviar a mensagem de erro
             return back()->withInput()->with('error', 'Conta não cadastrada!');
         }
     }
}
