<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
      
        return [
            'role' => 'required|exists:roles,id', // Ensure each selected role exists in the roles table

            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' ,  // Ensures the email is unique
            'password' => 'required|string|min:8|confirmed', // Ensure at least one role is selected
           
            // Ensure each selected role exists in the roles table
            'remember_token' => 'nullable|string|max:100',
            'created_at' => 'nullable',
            'updated_at' => 'nullable'
        ];
    }
}
