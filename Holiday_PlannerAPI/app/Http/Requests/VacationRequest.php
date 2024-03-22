<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class VacationRequest extends FormRequest{
    
    // Determines user authorization in the API
    public function authorize(): bool{
        return true;
    }
    
    // Determines required fields
    public function rules(): array{
        return[
            'title' => 'required',
            'local' => 'required',
            'description' => 'required',
            'date_plan' => 'required',
        ];
    }

    // View a custom message
    public function messages(): array{
        return[
            'title.required' => 'Title field is required!',
            'local.required' => 'Local field is required!',
            'description.required' => 'Description field is required!',
            'date_plan.required' => 'Date field is required!',
        ];
    }
}
