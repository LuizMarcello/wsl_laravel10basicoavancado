<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormRequestVenda extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $request = [];
        /* Se for "POST" entra aqui */
        if ($this->method() == "POST" || $this->method() == 'PUT') {
            $request = [
                'produto_id' => 'required',
                'cliente_id' => 'required',
            ];
        }
        /* Se for "GET" retorna string vazia, e não valida nada */
        return $request;
    }
}
