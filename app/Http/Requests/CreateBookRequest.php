<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 412)
        );
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|min:2|max:255',
            'author_id' => 'required|exists:authors,id',
            'isbn' => 'string',
            'publication_year' => 'integer',
            'genre' => 'string',
            'available_copies' => 'integer'
        ];
    }

}
