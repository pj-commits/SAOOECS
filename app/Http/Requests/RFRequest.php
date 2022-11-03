<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RFRequest extends FormRequest
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
            'event_id' => 'required',
            'date_filed' => 'required',
            'date_needed' => 'required',
            'payment' => 'required',
                'quantity.*' => 'required',
                'purpose.*' => 'required',
                'price.*' => 'required',
            'remarks' => 'required',
            'department_id' => 'required',

            'items' => 'required'
        ];
    }
}
