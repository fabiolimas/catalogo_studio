<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function store(Request $request){



        $produto = new Produto();

        $produto->nome=$request->nome;
        $produto->tamanho=$request->tamanho;
        $produto->referencia=$request->referencia;
        $produto->categoria=$request->categoria;
        $produto->cor=$request->cor;
        $produto->estoque=$request->estoque;
        $produto->preco=$request->preco;
        $produto->preco_venda=$request->preco_venda;
        $produto->marca=$request->marca;
        $produto->tamanho_salto=$request->tamanho_salto;


        if ($request->imagem != null) {


            $imagem = $request->file('imagem')->store('public/uploads');
            $produto->imagem=$imagem;


        }else{
            $produto->imagem=$request->imagemAtual;
        }




        $produto->save();


        return redirect()->back()->with('success', 'Produto adiconado com sucesso!');


    }

    public function update(Request $request){



        $data = $request->all();

        if ($request->preco) {
            $data['preco'] = str_replace(',', '.', $request->preco);
        }

        if ($request->preco_venda) {
            $data['preco_venda'] = str_replace(',', '.', $request->preco_venda);
        }


        if ($request->imagem != null) {
            $imagem = $request->file('imagem')->store('public/uploads');




            Produto::find($request->id)->update(['imagem' => $imagem]);
        } else {

            Produto::find($request->id)->update($data);
        }
        // return response()->json(['status' => 'Produto editado com sucesso!',]);
// return redirect()->back()->with('success', 'Produto editado com sucesso!');
}

public function delete(Request $request){
    Produto::find($request->id)->delete();

    return redirect()->back()->with('success', 'Produto excluido com sucesso!');


}

public function aumentaEstoque(Request $request){

    $produto=Produto::find($request->id);



    Produto::find($request->id)->update(["estoque"=>$produto->estoque+=1]);
    return redirect()->back()->with('success', 'Estoque alterado com sucesso!');

}
public function diminuiEstoque(Request $request){

    $produto=Produto::find($request->id);
if($produto->estoque <= 0){
    Produto::find($request->id)->update(["estoque"=>0]);
}else{
    Produto::find($request->id)->update(["estoque"=>$produto->estoque-=1]);

}





    return redirect()->back()->with('success', 'Estoque alterado com sucesso!');

}
}
