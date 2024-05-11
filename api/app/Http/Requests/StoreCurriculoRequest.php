<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCurriculoRequest extends FormRequest
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
            'nome' => 'required|min:3',
            'email' => 'required|email',
            'telefone' => 'required',
            'cargoDesejado' => 'required',
            'escolaridade' => 'required',
            'dataEnvio' => 'required',
            'horaEnvio' => 'required',
            'observacoes' => 'max:255',
            'ipCliente' => 'required',
            'fileCurriculo' => 'required|extensions:docx,pdf',
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O campo de nome é obrigatório',

            'email.required' => 'O campo de email é obrigatório',

            'telefone.required' => 'O campo de telefone é obrigatório',

            'cargoDesejado.required' => 'O campo de cargo desejado é obrigatório',

            'dataEnvio.required' => 'O campo de data de envio é obrigatório',

            'horaEnvio.required' => 'O campo de hora de envio é obrigatório',

            'escolaridade.required' => 'O campo de escolaridade é obrigatório',

            'ipCliente.required' => 'O ip do cliente é obrigatório',

            'fileCurriculo.required' => 'O campo de enviar o arquivo de currículo é obrigatório',
            'fileCurriculo.extensions' => 'O arquivo enviado deve possuir umas da extensões: .doc, .docx ou .pdf',

            'observacoes.max' => 'O campo observações é de tamanho maximo 255 caracteres',



        ];
    }
}
