<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TarefaRequest extends FormRequest
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
            "title" => "required|min:3|max:100|unique:tarefas,title",
            "tarefa_status_id" => "required|integer|exists:tarefa_status,id"        
        ];
    }
        
    public function messages()
    {
        return [
            'title.required' => 'O campo deve ser preenchido.',
            'title.min' => 'O campo deve ter no minimo 3 caracteres.',
            'title.max' => 'O campo deve ter no maximo 100 caracteres.',
            'title.unique' => 'Essa tarefa ja existe.',

            'tarefa_status_id.required' => 'O campo deve ser preenchido.',
            'tarefa_status_id.integer' => 'O campo status deve ser um número inteiro.',
            'tarefa_status_id.exists'  => 'O status informado não existe.'
        ];
    }
}
