<?php

use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\ClientesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

/* Prefixo "produtos" */
Route::prefix('produtos')->group(function () {
    /* http://localhost:8989/produtos */
    Route::get('/', [ProdutosController::class, 'index'])->name('produto.index');

    /* ==Cadastrar create== */
    /* get: Apresentar o formulário para cadastrar dados */
    /* http://localhost:8989/produtos/cadastrarProduto */
    Route::get('/cadastrarProduto', [ProdutosController::class, 'cadastrarProduto'])->name('cadastrar.produto');
    /* post: Cadastrar os dados no bando de dados */
    Route::post('/cadastrarProduto', [ProdutosController::class, 'cadastrarProduto'])->name('cadastrar.produto');


    /* ==Atualizar update== */
    /* get: Apresentar o formulãrio com os dados para serem editados */
    /* http://localhost:8989/produtos/cadastrarProduto */
    Route::get('/atualizarProduto/{id}', [ProdutosController::class, 'atualizarProduto'])->name('atualizar.produto');
    /* put: Para salvar os dados alterados no bando de dados */
    Route::put('/atualizarProduto/{id}', [ProdutosController::class, 'atualizarProduto'])->name('atualizar.produto');


    /* http://localhost:8989/produtos/adicionar */
    //Route::get('/adicionar', [ProdutosController::class, 'index'])->name('produto.index'); */

    /* http://localhost:8989/produtos/delete */
    Route::delete('/delete', [ProdutosController::class, 'delete'])->name('produto.delete');
});


/* Prefixo "clientes" */
Route::prefix('clientes')->group(function () {
    /* http://localhost:8989/clientes */
    Route::get('/', [ClientesController::class, 'index'])->name('cliente.index');

    /* ==Cadastrar create== */
    /* get: Apresentar o formulário para cadastrar dados */
    /* http://localhost:8989/produtos/cadastrarCliente */
    Route::get('/cadastrarCliente', [ClientesController::class, 'cadastrarCliente'])->name('cadastrar.cliente');
    /* post: Cadastrar os dados no bando de dados */
    Route::post('/cadastrarCliente', [ClientesController::class, 'cadastrarCliente'])->name('cadastrar.cliente');


    /* ==Atualizar update== */
    /* get: Apresentar o formulãrio com os dados para serem editados */
    /* http://localhost:8989/produtos/cadastrarCliente */
    Route::get('/atualizarCliente/{id}', [ClientesController::class, 'atualizarCliente'])->name('atualizar.cliente');
    /* put: Para salvar os dados alterados no bando de dados */
    Route::put('/atualizarCliente/{id}', [ClientesController::class, 'atualizarCliente'])->name('atualizar.cliente');


    /* http://localhost:8989/clientes/adicionar */
    //Route::get('/adicionar', [ClientesController::class, 'index'])->name('cliente.index'); */

    /* http://localhost:8989/clientes/delete */
    Route::delete('/delete', [ClientesController::class, 'delete'])->name('cliente.delete');
});