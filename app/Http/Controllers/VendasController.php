<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormRequestVenda;
use App\Models\Venda;
use App\Models\Componentes;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class VendasController extends Controller
{
    public function __construct(Venda $venda)
    {
        $this->venda = $venda;
    }

    public function index(Request $request)
    {
        /* Este "pesquisar" do $request, vem lá da tag "name"
           do "form" da view "paginacao.blade.php" */
        $pesquisar = $request->pesquisar;
        //dd($pesquisar);

        /* "this->venda" vem do método construtor acima,
            e representa o model "Venda". */
        /* "if ternário": Se for null, retorna uma string vazia,
                          para não dar êrros. */
        $findVenda = $this->venda->getVendasPesquisarIndex(search: $pesquisar ?? '');

        /* compact(): Permite que seja acessada a variável na wiew */
        return view('pages.vendas.paginacao', compact('findVenda'));
        //return 'vendasss';
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $buscaRegistro = Venda::find($id);
        $buscaRegistro->delete();
        return response()->json(['success' => true]);
    }

    public function cadastrarVenda(FormRequestVenda $request)
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
            Venda::create($data);

            Toastr::success('Gravado com sucesso');

            return redirect()->route('venda.index');
        }
        /* O depurador já entende que aqui é como se fosse 
           o "else()" do if() acima */
        /* Como aqui é o verbo "get", então retorna uma view */
        return view('pages.vendas.create');
    }
}
