<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreItemRequest extends FormRequest
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
            'beer_id' => [
                'required',
                'exists:beers,id'
            ],
            'container_id' => [
                'required',
                'exists:containers,id'
            ],
            'expiration_date' => [
                'required'
            ],
            'quantity' => [
                'required',
                'numeric',
                'min:1'
            ],
        ];
    }
}
