<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $produtos=Produto::orderBy('id','desc')->simplePaginate(30);


        return view('painel.home', compact('produtos'));
    }

    public function buscaProdutos(Request $request){

        $busca = $request->busca;
        if($busca == null || $busca == ''){
            $produtos=Produto::simplePaginate(30);
        }
        $produtos = Produto::where('nome', 'like', '%'.$busca.'%')
        ->orWhere('tamanho',$busca)
        ->orWhere('categoria', 'like', '%'.$busca.'%')
        ->orWhere('marca', 'like', '%'.$busca.'%')
        ->orWhere('cor', 'like', '%'.$busca.'%')
        ->orWhere('referencia', 'like', '%'.$busca.'%')
         ->simplePaginate(30);

        if ($produtos->count() >= 1) {
            return view('painel.buscas.busca_produtos', compact('produtos'));
        } else {

            return response()->json(['status' => 'Nenhum produto encontrado']);
        }
    }
}
