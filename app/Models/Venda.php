<?php

namespace App\Models;

use GuzzleHttp\ClientInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_da_venda',
        'produto_id',
        'cliente_id'
    ];

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function getVendasPesquisarIndex(string $search = '')
    {
        /* Como já estamos dentro do model "Produto", este "$this" por
           si só, já representa este model. */
        $produto = $this->where(function ($query) use ($search) {
            /* Condicional, se "$search" existir, não for uma string
               vazia, daí faz a consulta ao banco de dados. */
            if ($search) {
                $query->where('numero_da_venda', $search);
                /* O "like" quer dizer, parece com... */
                $query->orWhere('numero_da_venda', 'LIKE', "%{$search}%");
            }
        })->get();

        return $produto;
    }
}
