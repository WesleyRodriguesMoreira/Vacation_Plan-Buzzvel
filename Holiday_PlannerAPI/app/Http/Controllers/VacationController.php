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
     public function create(){
         // // Recuperar do banco de dados as situações
         // $situacoesContas = SituacaoConta::orderBy('nome', 'asc')->get();
 
         // Load the VIEW
         return view('vacation.create'
         // , ['situacoesContas' => $situacoesContas,]
         );
     }
 
 
     // === Register vacation plans in the database ===
     public function store(VacationRequest $request){

        // Validate the form and get the validated data
        $data = $request->validated();

        try {
            // Register in the database in the table vacation_plan the values of all fields
            $vacation = Vacation::create([
                'title' => $data['title'],
                'local' => $data['local'],
                'description' => $data['description'],
                'date_plan' => $data['date_plan'],
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

    //  // Listar as contas
    // public function index(Request $request)
    // {

    //     // Recuperar os registros do banco dados
    //     $contas = Conta::when($request->has('nome'), function ($whenQuery) use ($request) {
    //         $whenQuery->where('nome', 'like', '%' . $request->nome . '%');
    //     })
    //         ->when($request->filled('data_inicio'), function ($whenQuery) use ($request) {
    //             $whenQuery->where('vencimento', '>=', \Carbon\Carbon::parse($request->data_inicio)->format('Y-m-d'));
    //         })
    //         ->when($request->filled('data_fim'), function ($whenQuery) use ($request) {
    //             $whenQuery->where('vencimento', '<=', \Carbon\Carbon::parse($request->data_fim)->format('Y-m-d'));
    //         })
    //         ->with('situacaoConta')
    //         ->orderByDesc('created_at')
    //         ->paginate(10)
    //         ->withQueryString();

    //     // Carregar a VIEW
    //     return view('contas.index', [
    //         'contas' => $contas,
    //         'nome' => $request->nome,
    //         'data_inicio' => $request->data_inicio,
    //         'data_fim' => $request->data_fim,
    //     ]);
    // }


    // === Vacation Plan Details ===
    public function show(Vacation $vacation){
        // Load the VIEW
        return view('vacation.show', ['vacation' => $vacation]);
    }


    //  // Carregar o formulário editar a conta
    //  public function edit(Conta $conta)
    //  {
    //      // Recuperar do banco de dados as situações
    //      $situacoesContas = SituacaoConta::orderBy('nome', 'asc')->get();
 
    //      // Carregar a VIEW
    //      return view('contas.edit', [
    //          'conta' => $conta,
    //          'situacoesContas' => $situacoesContas,
    //      ]);
    //  }
}
