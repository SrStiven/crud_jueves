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

    public function messages() : array
    {
        return [
            'name.required' => 'El nombre debe ser requerido',
            'name.string' => 'El nombre debe ser sin numeros',
            'title.required' => 'El titulo es requerido',
            'title.string' => 'El titulo debe ser en texto',
            'count.required' => 'La cantidad de libros es requerida',
            'count.integer' => 'La cantidad de libros debe ser numeros enteros', 
            'gender.required' => 'El genero del libro debe ser requerido',
            'gender.string' => 'Se debe seleccionar un genero',
            'due_date.required' => 'La fecha es obligatoria',
            'due_date.date' => 'Debe ingresar una fecha válida',
            'file.mimes' => 'El archivo debe ser de tipo PDF, DOC o DOCX',
            'file.max' => 'El archivo no debe superar los 2MB',

            
        ];   
    }
}
