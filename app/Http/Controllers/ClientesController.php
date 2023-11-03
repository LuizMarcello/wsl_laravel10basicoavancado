<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormRequestCliente;
use App\Models\Cliente;
use App\Models\Componentes;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    public function __construct(Cliente $cliente)
    {
        $this->cliente = $cliente;
    }

    public function index(Request $request)
    {
        /* Este "pesquisar" do $request, vem lá da tag "name"
           do "form" da view "paginacao.blade.php" */
        $pesquisar = $request->pesquisar;
        //dd($pesquisar);

        /* "this->cliente" vem do método construtor acima,
            e representa o model "Cliente". */
        /* "if ternário": Se for null, retorna uma string vazia,
                          para não dar êrros. */
        $findCliente = $this->cliente->getClientesPesquisarIndex(search: $pesquisar ?? '');

        /* compact(): Permite que seja acessada a variável na wiew */
        return view('pages.clientes.paginacao', compact('findCliente'));
        //return 'clientesss';
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $buscaRegistro = Cliente::find($id);
        $buscaRegistro->delete();
        return response()->json(['success' => true]);
    }

    public function cadastrarCliente(FormRequestCliente $request)
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
            Cliente::create($data);

            Toastr::success('Gravado com sucesso');

            return redirect()->route('cliente.index');
        }
        /* O depurador já entende que aqui é como se fosse 
           o "else()" do if() acima */
        /* Como aqui é o verbo "get", então retorna uma view */
        return view('pages.clientes.create');
    }

    public function atualizarCliente(FormRequestCliente $request, $id)
    {
        /* Existem duas rotas iguais no web.php, uma "get" e outra "post" */
        /* Condicional para verificar se é "post" ou "get" */
        /* "method()" é do navegador */
        if ($request->method() == 'PUT') {
            /* Atualiza os dados */
            $data = $request->all();
            /* Model "Componentes" */
            /* Função para converter "ponto/virgula"  */
            $componentes = new Componentes();
            $data['valor'] = $componentes->formatacaoMascaraDinheiroDecimal($data['valor']);
            $buscaRegistro = Cliente::find($id);
            $buscaRegistro->update($data);
            return redirect()->route('cliente.index');
        }
        /* O depurador já entende que aqui é como se fosse 
           o "else()" do if() acima */
        /* Como aqui é o verbo "get", então retorna uma view */
        /* Eloquent ORM: Quando achar o cliente com o "id" igual
           ao "id" passado como parâmetro, pega ele pra mim */
        $findCliente = Cliente::where('id', '=', $id)->first();
        /* Esta variável estará acessivel na view "atualiza" */
        return view('pages.clientes.atualiza', compact('findCliente'));
    }
}
