<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BooksRequest extends FormRequest
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
        $rules = [
            'name' => 'required|string',
            'title' => 'required|string',
            'count' => 'required|integer',
            'gender' => 'required|string',
            'due_date' => 'required|date',
            'file' => 'nullable|mimes:pdf,doc,docx|max:2048',
        ];

        if($this->isMethod('POST')){
            $rules['file'] = 'required|mimes:pdf,doc,docx|max:2048';
        }

        return $rules;
    }
}
