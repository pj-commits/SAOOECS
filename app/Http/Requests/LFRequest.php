<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LFRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'end_date' => 'required|date|before:today', 
            'cash_advance' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'deduct' => 'required|regex:/^\d+(\.\d{1,2})?$/', 
                'item_number.*' => 'required', 
                'date_bought.*' => 'required', 
                'item.*' => 'required', 
                'price.*' => 'required', 
                'itemFrom.*' => 'required', 
                'itemTo.*' => 'required', 
                'image.*' => 'required|image|mimes:png,jpg,jpeg'
        ];
    }
}
