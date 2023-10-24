<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormRequestProduto;
use App\Models\Produto;
use App\Models\Componentes;
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

    public function delete(Request $request)
    {
        $id = $request->id;
        $buscaRegistro = Produto::find($id);
        $buscaRegistro->delete();
        return response()->json(['success' => true]);
    }

    public function cadastrarProduto(FormRequestProduto $request)
    {
        /* Existem duas rotas iguais no web.php, uma "get" e outra "post" */
        /* Condicional para verificar se é "post" ou "get" */
        /* "method()" é do navegador */
        if ($request->method() == 'POST') {
            // cria os dados
            $data = $request->all();
            /* Model "Componentes" */
            /* Função para converter "ponto/virgula"  */
            $componentes = new Componentes();
            $data['valor'] = $componentes->formatacaoMascaraDinheiroDecimal($data['valor']);
            Produto::create($data);

            return redirect()->route('produto.index');
        }
        /* O depurador já entende que aqui é como se fosse 
           o "else()" do if() acima */
        /* Como aqui é o verbo "get", então retorna uma view */
        return view('pages.produtos.create');
    }
}