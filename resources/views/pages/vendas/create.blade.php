@extends('index')

@section('content')
    {{-- Quando acionar o button abaixo, busca a rota com "post" --}}
    <form class="form" method="POST" action="{{ route('cadastrar.venda') }}">
        {{-- Token: Cross-Site Request Forgery --}}
        {{-- Para evitar o "ataque-de-formulário" --}}
        @csrf
        <div
            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center
           pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Adicionar nova venda</h1>
        </div>
        {{-- É através da tag "name", que é gravado no bd --}}
        {{-- Mesmo nome das colunas no bd --}}
        <div class="mb-3">
            <label class="form-label">Numeração</label>
            {{-- Variável vinda do método "cadastrarVenda()", do controller --}}
            <input type="text" disabled value="{{ $findNumeracao }}"
                class="form-control 
             @error('numero_da_venda') is-invalid @enderror" name="numero_da_venda">
            @if ($errors->has('numero_da_venda'))
                <div class="invalid-feedback">{{ $errors->first('numero_da_venda') }}</div>
            @endif
        </div>

        {{-- É através da tag "name", que é gravado no bd --}}
        {{-- Mesmo nome das colunas no bd --}}
        <div class="mb-3">
            <label class="form-label">Produto</label>
            <select class="form-select" name="produto_id">
                <option selected>Selecione um produto</option>
                {{-- Variável vinda do método "cadastrarVenda()", do controller --}}
                @foreach ($findProduto as $produto)
                    <option value="{{ $produto->id }}">{{ $produto->nome }}</option>
                @endforeach
            </select>
        </div>

        {{-- É através da tag "name", que é gravado no bd --}}
        {{-- Mesmo nome das colunas no bd --}}
        <div class="mb-3">
            <label class="form-label">Cliente</label>
            <select class="form-select" name="cliente_id">
                <option selected>Selecione um cliente</option>
                {{-- Variável vinda do método "cadastrarVenda()", do controller --}}
                @foreach ($findCliente as $cliente)
                    <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Gravar</button>
    </form>
@endsection
