<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        "nome",
        "email",
        "endereco",
        "logradouro",
        "cep",
        "bairro"
    ];

    public function getClientesPesquisarIndex(string $search = '')
    {
        /* Como já estamos dentro do model "Cliente", este "$this" por
           si só, já representa este model. */
        $clientes = $this->where(function ($query) use ($search) {
            /* Condicional, se "$search" existir, não for uma string
               vazia, daí faz a consulta ao banco de dados. */
            if ($search) {
                $query->where('nome', $search);
                /* O "like" quer dizer, parece com... */
                $query->orWhere('nome', 'LIKE', "%{$search}%");
            }
        })->get();

        return $clientes;
    }
}
