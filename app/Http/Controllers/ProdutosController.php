<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutosController extends Controller
{
    public function __construct(Produto $produto)
    {
        $this->produto = $produto;
    }

    public function index(Request $request)
    {
        /* Este "pesquisar" do $request, vem lá da tag "name"
           do "form" da view "paginacao.blade.php" */
        $pesquisar = $request->pesquisar;
        //dd($pesquisar);

        /* "this->produto" vem do método construtor acima,
            e representa o model "Produto". */
        /* "if ternário": Se for null, retorna uma string vazia,
                          para não dar êrros. */
        $findProduto = $this->produto->getProdutosPesquisarIndex(search: $pesquisar ?? '');

        /* compact(): Permite que seja acessada a variável na wiew */
        return view('pages.produtos.paginacao', compact('findProduto'));
        //return 'produtosss';
    }

    public function delete(Request $requeste)
    {

    }
}