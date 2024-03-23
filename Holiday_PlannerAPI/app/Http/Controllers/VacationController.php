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
         // Load the VIEW
         return view('vacation.create');
     }


     // === List Vacation Plans ===
     public function index(Request $request){

        // Retrieve the records from the database
        $vacation = Vacation::when($request->has('title'), function ($whenQuery) use ($request){
            $whenQuery->where('title', 'like', '%' . $request->title . '%');
        })
            ->when($request->has('local'), function ($whenQuery) use ($request){
                $whenQuery->where('local', 'like', '%' . $request->local . '%');
            })
            ->when($request->filled('date_plan'), function ($whenQuery) use ($request) {
                $whenQuery->where('date_plan', '=', \Carbon\Carbon::parse($request->date_plan)->format('Y-m-d'));
            })
            ->orderByDesc('created_at')
            ->paginate(5)
            ->withQueryString();

        // Load the VIEW
        return view('vacation.index', [
            'vacation' => $vacation,
            'title' => $request->title,
            'local' => $request->local,
            'date_plan' => $request->date_plan,
        ]);
    }


    // === Vacation Plan Details ===
    public function show(Vacation $vacation){
        // Load the VIEW
        return view('vacation.show', ['vacation' => $vacation]);
    }
 

    // === Carregar o formulário editar a conta ===
    public function edit(Vacation $vacation){
        // Load the VIEW
        return view('vacation.edit', ['vacation' => $vacation]);
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
        } catch (Exception $e){
            // Save Log
            Log::warning('Vacation Plan not registered!', ['error' => $e->getMessage()]);
            
            // Redirect the user and send the error message
            return back()->withInput()->with('error', 'Vacation Plan not registered!');
        }
     }


    // === Edit the Vacation Plan ===
    public function update(VacationRequest $request, Vacation $vacation){
        // Validate the form and get the validated data
        $data = $request->validated();

        try {
            // Editar as informações do registro no banco de dados
            $vacation->update([
                'title' => $data['title'],
                'local' => $data['local'],
                'description' => $data['description'],
                'date_plan' => $data['date_plan'],
            ]);

            // Save Log
            Log::info('Vacation Plan Successfully Edited', ['id' => $vacation->id, 'vacation' => $vacation]);

            // Redirect the user and send the success message
            return redirect()->route('vacation.show', ['vacation' => $vacation->id])->with('success', 'Vacation Plan Successfully Edited');

        } catch (Exception $e) {

            // Save Log
            Log::warning('Unedited Vacation Plan!', ['error' => $e->getMessage()]);

            // Redirect the user and send the error message
            return back()->withInput()->with('error', 'Unedited Vacation Plan!');
        }
    }


    // === Delete the Vacation Plan from the database ===
    public function destroy(Vacation $vacation){

        try{
        // Delete the record from the database
        $vacation->delete();

        // Save Log
        Log::info('Vacation Plan Successfully Deleted', ['id' => $vacation->id, 'vacation' => $vacation]);

        // Redirect the user and send the success message
        return redirect()->route('vacation.index')->with('success', 'Vacation Plan Successfully Deleted');

        }catch (Exception $e){
            // Save Log
            Log::warning('Vacation Plan Not Deleted!', ['error' => $e->getMessage()]);

            // Redirect the user and send the error message
            return back()->withInput()->with('error', 'Vacation Plan Not Deleted!');
        }

        
    }

     


    


     
}
