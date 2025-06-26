<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookDetailRequest extends FormRequest
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
            'number_of_pages' => 'required|integer|min:1',
            'isbn' => 'required|string|min:1|max:255',
            'year' => 'required|integer|digits:4',
            'book_id' => 'required|integer|exists:books,id'
        ];
    }
}
