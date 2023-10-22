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

    /* get: Apresentar alguma coisa */
    /* http://localhost:8989/produtos/cadastrarProduto */
    Route::get('/cadastrarProduto', [ProdutosController::class, 'cadastrarProduto'])->name('cadastrar.produto');

    /* post: Cadastrar dados no bando de dados */
    Route::post('/cadastrarProduto', [ProdutosController::class, 'cadastrarProduto'])->name('cadastrar.produto');

    /* http://localhost:8989/produtos/adicionar */
    //Route::get('/adicionar', [ProdutosController::class, 'index'])->name('produto.index'); */

    /* http://localhost:8989/produtos/delete */
    Route::delete('/delete', [ProdutosController::class, 'delete'])->name('produto.delete');
});