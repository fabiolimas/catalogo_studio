<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [SiteController::class, 'index'] )->name('home-site');
Route::get('/busca-produtos', [App\Http\Controllers\SiteController::class, 'buscaProdutos'])->name('busca-produtos');

Auth::routes();

Route::get('/painel/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::put('/editar/produto', [App\Http\Controllers\ProdutoController::class, 'update'])->name('update-produto')->middleware('auth');
Route::get('/delete/{id}', [App\Http\Controllers\ProdutoController::class, 'delete'])->name('delete')->middleware('auth');
Route::get('/aumenta-estoque/{id}', [App\Http\Controllers\ProdutoController::class, 'aumentaEstoque'])->name('aumenta-estoque')->middleware('auth');
Route::get('/diminui-estoque/{id}', [App\Http\Controllers\ProdutoController::class, 'diminuiEstoque'])->name('diminui-estoque')->middleware('auth');
Route::post('/adicionar-produto', [App\Http\Controllers\ProdutoController::class, 'store'])->name('adicionar-produto')->middleware('auth');

