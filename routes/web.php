<?php

use App\Http\Controllers\ProdutosController;
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