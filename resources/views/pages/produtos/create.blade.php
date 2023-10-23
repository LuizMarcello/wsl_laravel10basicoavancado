@extends('index')

@section('content')
    {{-- Quando acionar o button abaixo, busca a rota com "post" --}}
    <form class="form" method="POST" action="{{ route('cadastrar.produto') }}">
        {{-- Token: Cross-Site Request Forgery --}}
        {{-- Para evitar o "ataque-de-formulário" --}}
        @csrf
        <div
            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center
           pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Adicionar novo produto</h1>
        </div>
        {{-- É através da tag "name" que é gravado no bd --}}
        {{-- Mesmo nome das colunas no bd --}}
        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" class="form-control 
             @error('nome') is-invalid @enderror" name="nome">
            @if ($errors->has('nome'))
                <div class="invalid-feedback">{{ $errors->first('nome') }}</div>
            @endif
        </div>
        <div class="mb-3">
            <label class="form-label">Valor</label>
            <input class="form-control 
             @error('valor') is-invalid @enderror" name="valor">
            @if ($errors->has('valor'))
                <div class="invalid-feedback">{{ $errors->first('valor') }}</div>
            @endif
        </div>
        <button type="submit" class="btn btn-success">Cadastrar</button>
    </form>
@endsection
