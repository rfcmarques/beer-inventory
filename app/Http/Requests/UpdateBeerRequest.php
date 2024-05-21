<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBeerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255'
            ],
            'brewery_id' => [
                'required',
                'exists:breweries,id',
            ],
            'style_id' => [
                'required',
                'exists:styles,id'
            ],
            'abv' => [
                'required',
                'between:0,100',
                'decimal:0,2'
            ]
        ];
    }
}
