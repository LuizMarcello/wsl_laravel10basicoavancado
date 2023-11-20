<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioFormRequest;
use App\Models\User;
use App\Models\Componentes;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index(Request $request)
    {
        /* Este "pesquisar" do $request, vem lá da tag "name"
           do "form" da view "paginacao.blade.php" */
        $pesquisar = $request->pesquisar;
        //dd($pesquisar);

        /* "this->user" vem do método construtor acima,
            e representa o model "User". */
        /* "if ternário": Se for null, retorna uma string vazia,
                          para não dar êrros. */
        $findUsuario = $this->user->getUsuariosPesquisarIndex(search: $pesquisar ?? '');

        /* compact(): Permite que seja acessada a variável na wiew */
        return view('pages.usuarios.paginacao', compact('findUsuario'));
        //return 'usersss';
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $buscaRegistro = User::find($id);
        $buscaRegistro->delete();

        Toastr::success('Excluido com sucesso');
        return response()->json(['success' => true]);
    }

    public function cadastrarUsuario(UsuarioFormRequest $request)
    {
        /* Existem duas rotas iguais no web.php, uma "get" e outra "post" */
        /* Condicional para verificar se é "post" ou "get" */
        /* "method()" é do navegador */
        if ($request->method() == 'POST') {
            // Se for "post", cria os dados
            $data = $request->all();
            /* Manipulando o $data */
            $data['password'] = Hash::make($data['password']);
            User::create($data);

            Toastr::success('Gravado com sucesso');
            /* E retorna esta view */
            return redirect()->route('usuario.index');
        }
        /* O depurador já entende que aqui é como se fosse 
           o "else()" do if() acima */
        /* Como aqui é o verbo "get", então retorna esta view */
        return view('pages.usuarios.create');
    }

    public function atualizarUsuario(UsuarioFormRequest $request, $id)
    {
        /* Existem duas rotas iguais no web.php, uma "get" e outra "post" */
        /* Condicional para verificar se é "post" ou "get" */
        /* "method()" é do navegador */
        if ($request->method() == 'PUT') {
            /* Atualiza os dados */
            $data = $request->all();
            //dd($data);
            $data['password'] = Hash::make($data['password']);
            $buscaRegistro = User::find($id);
            $buscaRegistro->update($data);

            Toastr::success('Atualizado com sucesso');
            return redirect()->route('usuario.index');
        }
        /* O depurador já entende que aqui é como se fosse 
           o "else()" do if() acima */
        /* Como aqui é o verbo "get", então retorna uma view */
        /* Eloquent ORM: Quando achar o user com o "id" igual
           ao "id" passado como parâmetro, pega ele pra mim */
        $findUsuario = User::where('id', '=', $id)->first();
        /* Esta variável estará acessivel na view "atualiza" */
        return view('pages.usuarios.atualiza', compact('findUsuario'));
    }
}