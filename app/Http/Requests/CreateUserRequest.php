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
             'email' => 'required|email|unique:users,email,' . $userId,  // Ensures the email is unique, excluding the current user's ID
             'password' => 'required|string|min:8|confirmed', // Ensure the password is confirmed and has a minimum length of 8 characters
             'role' => [
                 function ($attribute, $value, $fail) {
                     // Get the authenticated user's role
                     $authUser = Auth()->user();
                     
                     // Check if the authenticated user is a super admin
                     if ($authUser->hasRole('super admin')) {
                         // If the user is super admin, allow adding super admin, admin, or student roles
                         return;
                     } else {
                         // For other users, restrict role creation to students only
                         if ($value !== 'student') {
                             $fail('Only super admins can assign admin or super admin roles.');
                         }
                     }
                 },
             ],
             'remember_token' => 'nullable|string|max:100',
             'created_at' => 'nullable',
             'updated_at' => 'nullable'
         ];
     }
     
    
}
