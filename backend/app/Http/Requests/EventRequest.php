<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'date_start' => 'required|date',
            'date_end' => 'required|date',
            'silver_price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'gold_price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'platinum_price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'capacity' => 'required|numeric|gt:0'
        ];
    }
}
