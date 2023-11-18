<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormRequestVenda;
use App\Mail\ComprovanteDeVendaEmail;
use App\Models\Venda;
use App\Models\Produto;
use App\Models\Cliente;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

    public function cadastrarVenda(FormRequestVenda $request)
    {
        $findNumeracao = Venda::max('numero_da_venda') + 1;
        $findProduto = Produto::all();
        $findCliente = Cliente::all();

        /* Existem duas rotas iguais no web.php, uma "get" e outra "post" */
        /* Condicional para verificar se é "post" ou "get" */
        /* "method()" é do navegador */
        if ($request->method() == 'POST') {
            // cria os dados
            $data = $request->all();
            $data['numero_da_venda'] = $findNumeracao;
            //dd($data);

            Venda::create($data);
            Toastr::success('Gravado com sucesso');
            return redirect()->route('vendas.index');
        }

        /* O depurador já entende que aqui é como se fosse 
           o "else()" do if() acima */
        /* Como aqui é o verbo "get", então retorna uma view */
        /* "compact()": Enviando para a view retornada */
        return view('pages.vendas.create', compact('findNumeracao', 'findProduto', 'findCliente'));
    }

    public function enviaComprovantePorEmail($id)
    {
        /* Pega todos os dados do 1º registro que possui o "id" igual ao "id" passado no parâmetro */
        /* ORM Eloquent */
        $buscaVenda = Venda::where('id', '=', $id)->first();

        /* Buscando do relacionamento com produtos */
        /* "produto()": Função no model Venda.php */
        $produtoNome = $buscaVenda->produto->nome;

        /* Buscando do relacionamento com clientes */
        /* "cliente()": Função no model Venda.php */
        $clienteEmail = $buscaVenda->cliente->email;

        /* Buscando do relacionamento com clientes */
        /* "cliente()": Função no model Venda.php */
        $clienteNome = $buscaVenda->cliente->nome;
        //dd($clienteEmail);

        $sendMailData = [
            'produtoNome' => $produtoNome,
            'clienteNome' => $clienteNome,
        ];

        Mail::to($clienteEmail)->send(new ComprovanteDeVendaEmail($sendMailData));

        Toastr::success('Email enviado com sucesso');
        return redirect()->route('vendas.index');
    }
}

