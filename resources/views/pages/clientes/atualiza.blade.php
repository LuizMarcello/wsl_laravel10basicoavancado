@extends('index')

@section('content')
    {{-- A variável "findCliente" vem lá do controler, da função
        "atualizarCliente", do compact() --}}

    {{-- Quando acionar o button abaixo, busca a rota com "post" --}}
    <form class="form" method="POST" action="{{ route('atualizar.cliente', $findCliente->id) }}">
        {{-- Token: Cross-Site Request Forgery --}}
        {{-- Para evitar o "ataque-de-formulário" --}}
        @csrf
        @method('PUT')
        <div
            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center
           pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Editar cliente</h1>
        </div>
        {{-- É através da tag "name" que é gravado no bd --}}
        {{-- Mesmo nome das colunas no bd --}}
        <div class="mb-3">
            <label class="form-label">Nome</label>
            {{-- Se houver alguma alteração nos dados, ele retorna para o formulário o que
                 foi alterado(?), senão retorna o que já estava antes(:) --}}
            <input type="text" value="{{ isset($findCliente->nome) ? $findCliente->nome : old('nome') }}"
                class="form-control 
             @error('nome') is-invalid @enderror" name="nome">
            @if ($errors->has('nome'))
                <div class="invalid-feedback">{{ $errors->first('nome') }}</div>
            @endif
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            {{-- Se houver alguma alteração nos dados, ele retorna para o formulário o que
                 foi alterado(?), senão retorna o que já estava antes(:) --}}
            <input type="text" value="{{ isset($findCliente->email) ? $findCliente->email : old('email') }}"
                class="form-control 
             @error('email') is-invalid @enderror" name="email">
            @if ($errors->has('email'))
                <div class="invalid-feedback">{{ $errors->first('email') }}</div>
            @endif
        </div>
        <div class="mb-3">
            <label class="form-label">Endereço</label>
            {{-- Se houver alguma alteração nos dados, ele retorna para o formulário o que
                 foi alterado(?), senão retorna o que já estava antes(:) --}}
            <input type="text" value="{{ isset($findCliente->endereco) ? $findCliente->endereco : old('endereco') }}"
                class="form-control 
             @error('endereco') is-invalid @enderror" name="endereco">
            @if ($errors->has('endereco'))
                <div class="invalid-feedback">{{ $errors->first('endereco') }}</div>
            @endif
        </div>
        <div class="mb-3">
            <label class="form-label">Logradouro</label>
            {{-- Se houver alguma alteração nos dados, ele retorna para o formulário o que
                 foi alterado(?), senão retorna o que já estava antes(:) --}}
            <input type="text"
                value="{{ isset($findCliente->logradouro) ? $findCliente->logradouro : old('logradouro') }}"
                class="form-control 
             @error('logradouro') is-invalid @enderror" name="logradouro">
            @if ($errors->has('logradouro'))
                <div class="invalid-feedback">{{ $errors->first('logradouro') }}</div>
            @endif
        </div>
        <div class="mb-3">
            <label class="form-label">Cep</label>
            {{-- Se houver alguma alteração nos dados, ele retorna para o formulário o que
                 foi alterado(?), senão retorna o que já estava antes(:) --}}
            <input type="text" value="{{ isset($findCliente->cep) ? $findCliente->cep : old('cep') }}"
                class="form-control 
             @error('cep') is-invalid @enderror" name="cep">
            @if ($errors->has('cep'))
                <div class="invalid-feedback">{{ $errors->first('cep') }}</div>
            @endif
        </div>
        <div class="mb-3">
            <label class="form-label">Bairro</label>
            {{-- Se houver alguma alteração nos dados, ele retorna para o formulário o que
                 foi alterado(?), senão retorna o que já estava antes(:) --}}
            <input type="text" value="{{ isset($findCliente->bairro) ? $findCliente->bairro : old('bairro') }}"
                class="form-control 
             @error('bairro') is-invalid @enderror" name="bairro">
            @if ($errors->has('bairro'))
                <div class="invalid-feedback">{{ $errors->first('bairro') }}</div>
            @endif
        </div>
        <button type="submit" class="btn btn-success">Gravar</button>
    </form>
@endsection
