<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;

class CreateUserRequest extends FormRequest
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
    public static function rules($userId = null)
    {
        dd('g');
        if ($userId === null) {
            $userId = request()->route('user');  // Fetch the user ID from the route
        }
    
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' ,  // Ensures the email is unique
            'password' => 'required|string|min:8|confirmed', // Ensure at least one role is selected
            'role' => [
                function ()  {
                    // Check if the user has the 'student' role
                    
                    
                    if (Auth()->user()->hasRole('stuent')) {
                        // If the user is a student, bypass validation
                        return;
                    }else{
                        $fail('The user ID is required.');
                    }
            
                    // If the user is not a student, apply validation
                    
                },
            ] ,// Ensure each selected role exists in the roles table
            'remember_token' => 'nullable|string|max:100',
            'created_at' => 'nullable',
            'updated_at' => 'nullable'
        ];
    }
    
}
