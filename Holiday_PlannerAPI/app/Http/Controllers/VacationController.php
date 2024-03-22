<?php
namespace App\Http\Controllers;
use App\Http\Requests\VacationRequest;
use App\Models\Vacation;
use Exception;
use Carbon\Carbon;
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
     public function store(VacationRequest $request){

         // Validate the form
         $request->validated();
 
         try {
             // Register in the database in the table vacation_plan the values of all fields
             $vacation = Vacation::create([
                 'title' => $request->title,
                 'local' => $request->local,
                 'description' => $request->description,
                 'date_plan' => $request->date,
             ]);
 
             // Redirect the user and send the success message
             return redirect()->route('vacation.show', ['vacation' => $vacation->id])->with('success', 'Vacation plan successfully registered');

         } catch (Exception $e) {
 
             // Save Log
             Log::warning('Vacation Plan not registered!', ['error' => $e->getMessage()]);
 
             // Redirect the user and send the error message
             return back()->withInput()->with('error', 'Vacation Plan not registered!');
         }
     }
}
