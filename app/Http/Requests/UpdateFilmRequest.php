<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFilmRequest extends FormRequest
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
            //
            'name'=> 'nullable |string',
            'Rating' => 'nullable | integer',
            'description' => 'nullable | max:255',
            'show_time' => 'nullable | date ',
            'image' =>'mimes:jpg,bmp,png',
        ];
    }
}