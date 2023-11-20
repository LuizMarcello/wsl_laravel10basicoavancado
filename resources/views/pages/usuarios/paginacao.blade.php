{{-- Extendendo a view "index.blade.php" --}}
@extends('index')

{{-- Criando aqui a seção "content" --}}
@section('content')
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center
           pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Usuarios</h1>
    </div>
    <div>
        <form action="{{ route('usuario.index') }}" method="GET">
            {{-- Pelo "name", dá para identificar o que foi digitado neste input --}}
            <input type="text" name="pesquisar" placeholder="Digite o nome" />
            <button>Pesquisar</button>
            <a type="button" href="{{ route('cadastrar.usuario') }}" class="btn btn-success float-end">
                Incluir Usuario
            </a>
        </form>
        <div class="table-responsive mt-4">
            @if ($findUsuario->isEmpty())
                <p> Não existem dados!</p>
            @else
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($findUsuario as $usuario)
                            <tr>
                                <td>{{ $usuario->name }}</td>
                                <td>{{ $usuario->email }}</td>
                                <td>
                                    {{-- Assim, vai enviar um "get", será para a rota "get" --}}
                                    <a href="{{ route('atualizar.usuario', $usuario->id) }}" class="btn btn-light btn-sm">
                                        Editar
                                    </a>

                                    {{-- Este "meta", é para enviar um token da sessão (Laravel com ajax) --}}
                                    <meta name='csrf-token' content="{{ csrf_token() }}" />
                                    {{-- Dispara esta função que está no "projeto.js" --}}
                                    {{-- Ela espera os parâmetros: rotaUrl e idDoRegistro  --}}
                                    <a onclick="deleteRegistroPaginacao('{{ route('usuario.delete') }}',  {{ $usuario->id }} )"
                                        class="btn btn-danger btn-sm">
                                        Excluir
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection
