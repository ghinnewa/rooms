<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Card;

class CreateCardRequest extends FormRequest
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
    { $cardId = $this->route('card');
        return [


            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
          
           
            'phone1' => 'required|string|max:255',
            
          
    
            'qrcode' => '',
            'image' => '',
            'expiration' => 'date|after:now',
    
            'paid' => 'boolean',
            'deleted_at' => 'nullable',
            'created_at' => 'nullable',
            'updated_at' => 'nullable',
            'category_id' => 'required',
          
            'comment' => 'nullable',
            'facebook_url' => 'nullable|string|max:255',
            'twitter_url' => 'nullable|string|max:255',
            'linkedin_url' => 'nullable|string|max:255',
          
            'instagram_url' => 'nullable|string|max:255',
            'youtube_url' => 'nullable|string|max:255',
            'identity_file1' => '',
            'identity_file2' => '',
            'city' => 'required|string|max:255',
    
    
    
    
       
            'membership_number' => 'required|digits:6',  // Ensuring it is exactly 6 digits
            'national_number' => [
                'required',
                'regex:/^(1|2)[0-9]{11}$/',  // Must start with 1 or 2 and have exactly 12 digits
            ],
            'user_id' => [
                'required',
                'exists:users,id',
                function ($attribute, $value, $fail) use ($cardId) {
                    if (\App\Models\Card::where('user_id', $value)->where('id', '!=', $cardId)->exists()) {
                        $fail('This user already has a card.');
                    }
                },
            ],
            // Other validation rules...
        ];
        return Card::$rules;
    }
}
