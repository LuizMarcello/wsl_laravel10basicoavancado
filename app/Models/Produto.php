<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    /* O "model" sempre está em contato com o banco de dados. */

    protected $fillable = ['nome', 'valor'];

    public function getProdutosPesquisarIndex(string $search = '')
    {
        /* Como já estamos dentro do model "Produto", este "$this" por
           si só, já representa este model. */
        $produto = $this->where(function ($query) use ($search) {
            /* Condicional, se "$search" existir, não for uma string
               vazia, daí faz a consulta ao banco de dados. */
            if ($search) {
                $query->where('nome', $search);
                /* O "like" quer dizer, parece com... */
                $query->orWhere('nome', 'LIKE', "%{$search}%");
            }
        })->get();

        return $produto;
    }

}