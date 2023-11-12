{{-- Extendendo a view "index.blade.php" --}}
@extends('index')

{{-- Criando aqui a seção "content" --}}
@section('content')
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center
           pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Vendas</h1>
    </div>
    <div>
        <form action="{{ route('vendas.index') }}" method="GET">
            {{-- Pelo "name", dá para identificar o que foi digitado neste input --}}
            <input type="text" name="pesquisar" placeholder="Digite o nome" />
            <button>Pesquisar</button>
            <a type="button" href="{{ route('cadastrar.venda') }}" class="btn btn-success float-end">
                Incluir Venda
            </a>
        </form>
        <div class="table-responsive mt-4">
            {{-- Variável que vem do controler/index() --}}
            @if ($findVenda->isEmpty())
                <p> Não existem dados!</p>
            @else
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Numeração</th>
                            <th>Produto</th>
                            <th>Cliente</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($findVenda as $venda)
                            <tr>
                                <td>{{ $venda->numero_da_venda }}</td>
                                <td>{{ $venda->produto->nome }}</td>
                                <td>{{ $venda->cliente->nome }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection
