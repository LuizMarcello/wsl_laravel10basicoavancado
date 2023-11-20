@extends('index')

@section('content')
    {{-- A variável "findProduto" vem lá do controler, da função
        "atualizarProduto", do compact() --}}

    {{-- Quando acionar o button abaixo, busca a rota com "post" --}}
    <form class="form" method="POST" action="{{ route('atualizar.usuario', $findUsuario->id) }}">
        {{-- Token: Cross-Site Request Forgery --}}
        {{-- Para evitar o "ataque-de-formulário" --}}
        @csrf
        @method('PUT')
        <div
            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center
           pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Editar usuario</h1>
        </div>
        {{-- É através da tag "name" que é gravado no bd --}}
        {{-- Mesmo nome das colunas no bd --}}
        <div class="mb-3">
            <label class="form-label">Nome</label>
            {{-- Se houver alguma alteração nos dados, ele retorna para o formulário o que
                 foi alterado(?), senão retorna o que já estava antes(:) --}}
            <input type="text" value="{{ isset($findUsuario->name) ? $findUsuario->name : old('name') }}"
                class="form-control 
             @error('name') is-invalid @enderror" name="name">
            @if ($errors->has('name'))
                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
            @endif
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            {{-- Se houver alguma alteração nos dados, ele retorna para o formulário o que
                 foi alterado(?), senão retorna o que já estava antes(:) --}}
            <input value="{{ isset($findUsuario->email) ? $findUsuario->email : old('email') }}"
                class="form-control 
             @error('email') is-invalid @enderror" name="email">
            @if ($errors->has('valor'))
                <div class="invalid-feedback">{{ $errors->first('email') }}</div>
            @endif
        </div>
        <div class="mb-3">
            <label class="form-label">Nova senha</label>
            <input type="password" class="form-control 
             @error('password') is-invalid @enderror"
                name="password">
            @if ($errors->has('password'))
                <div class="invalid-feedback">{{ $errors->first('password') }}</div>
            @endif
        </div>
        <button type="submit" class="btn btn-success">Gravar</button>
    </form>
@endsection
