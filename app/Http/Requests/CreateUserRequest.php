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
        if ($userId === null) {
            $userId = request()->route('user');  // Fetch the user ID from the route
        }
    
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $userId,  // Unique validation, ignoring the current user's email
            'password' => 'nullable|string|min:8|confirmed',  // Password optional when editing
            'role' => 'required|exists:roles,id',  // Role must exist
            'remember_token' => 'nullable|string|max:100',
            'created_at' => 'nullable',
            'updated_at' => 'nullable',
        ];
    }
    
}
