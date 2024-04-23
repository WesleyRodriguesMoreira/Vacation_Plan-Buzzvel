<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:5', 
        ];
    }

    public function messages(): array
    {
       return[
        'name.required' => 'Campo nome é obrigatório',
        'email.required' => 'Campo email é obrigatório',
        'password.min' => 'Campo valor só pode te no minímo 5 caracteres',
        'password.required' => 'Campo senha é obrigatório',
       ]; 
    }
}
