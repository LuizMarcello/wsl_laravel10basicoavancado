<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutosController extends Controller
{
    public function index()
    {
        $findProduto = Produto::all();
        //$findProduto = Produto::where('nome', '!=', 'Luiz Marcello')->get();
        //dd($findProduto);
        /* compact(): Permite que seja acessada a variável na wiew */
        return view('pages.produtos.paginacao', compact('findProduto'));
        //return 'produtosss';
    }
}