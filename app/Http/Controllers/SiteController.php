<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class SiteController extends Controller
{
public function index(){


    $produtos=Produto::paginate(30);

    return view('site.home', compact('produtos'));
}
public function buscaProdutos(Request $request){

    $busca = $request->busca;
    if($busca == null || $busca == ''){
        $produtos=Produto::paginate(30);
    }
    $produtos = Produto::where('nome', 'like', '%'.$busca.'%')
    ->orWhere('tamanho',$busca)
    ->orWhere('categoria', 'like', '%'.$busca.'%')
    ->orWhere('marca', 'like', '%'.$busca.'%')
    ->orWhere('cor', 'like', '%'.$busca.'%')
    ->orWhere('referencia', 'like', '%'.$busca.'%')
     ->paginate(30);

    if ($produtos->count() >= 1) {
        return view('site.buscas.busca_produtos', compact('produtos'));
    } else {

        return response()->json(['status' => 'Nenhum produto encontrado']);
    }
}
}
