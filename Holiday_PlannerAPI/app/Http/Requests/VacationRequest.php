<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class VacationRequest extends FormRequest{
    
    public function authorize(): bool{
        return false;
    }
    
    public function rules(): array
    {
        return [
            'title' => 'required',
            'local' => 'required',
            'description' => 'required',
            'date_plan' => 'required',
        ];
    }

    public function messages(): array
    {
        return[
            'title.required' => 'Title field is required!',
            'local.required' => 'Local field is required!',
            'description.max' => 'Description field is required!',
            'date_plan.required' => 'Date field is required!',
        ];
    }
}
