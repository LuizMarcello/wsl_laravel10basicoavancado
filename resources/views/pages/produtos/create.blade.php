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
            <input type="text" class="form-control" name="nome">
        </div>
        <div class="mb-3">
            <label class="form-label">Valor</label>
            <input class="form-control" name="valor">
        </div>
        <button type="submit" class="btn btn-success">Cadastrar</button>
    </form>
@endsection
