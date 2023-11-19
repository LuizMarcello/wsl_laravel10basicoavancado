<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Cliente;
use App\Models\Venda;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalDeProdutosCadastrados = $this->buscaTotalProdutosCadastrados();
        $totalDeClientesCadastrados = $this->buscaTotalClientesCadastrados();
        $totalDeVendasCadastradas = $this->buscaTotalVendasCadastradas();
        $totalDeUsuariosCadastrados = $this->buscaTotalUsuariosCadastrados();

        /* compact(): Enviando para a view */
        return view('pages.dashboard.dashboard', compact(
         'totalDeClientesCadastrados',
         'totalDeProdutosCadastrados',
         'totalDeVendasCadastradas',
         'totalDeUsuariosCadastrados'
        ));
    }

    public function buscaTotalProdutosCadastrados()
    {
        /* ORM Eloquent */
        $find = Produto::all()->count();
        return $find;
    }

    public function buscaTotalClientesCadastrados()
    {
        /* ORM Eloquent */
        $find = Cliente::all()->count();
        return $find;
    }

    public function buscaTotalVendasCadastradas()
    {
        /* ORM Eloquent */
        $find = Venda::all()->count();
        return $find;
    }

    public function buscaTotalUsuariosCadastrados()
    {
        /* ORM Eloquent */
        $find = User::all()->count();
        return $find;
    }
}