<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
     public function index(){
        $produtos = Produto::all();
        return response()->json($produtos);
     }

      public function store(Request $request){
        $produto = Produto::create([
            'marca'=> $request->marca,
            'descricao'=> $request->descricao,
            'valor_unitario'=> $request->valor_unitario,
            'quantidade_estoque'=> $request->quantidade_estoque,
            'faixa_etaria_minima'=> $request->faixa_etaria_minima,
        ]);
        return response()->json($produto);
    }

        public function update($id){
        $produtos = Produto::find($id);
        if(!$produtos){
            return response()->json('Produto não encontrado');
        }
        if(isset($request->marca)){
            $$produtos->marca = $request->marca;
        }
        if (isset($request->descricao)){
            $produtos->descricao = $request->descricao;
        }
         if (isset($request->valor_unitario)){
            $produtos->valor_unitario = $request->valor_unitario;
        }
         if (isset($request->quantidade_estoque)){
            $produtos->quantidade_estoque = $request->quantidade_estoque;
        }
         if (isset($request->faixa_etaria_minima)){
            $produtos->faixa_etaria_minima = $request->faixa_etaria_minima;
        }

        $produtos->update();
        return response()->json('Produtos atualizados');
    }

        function delete($id){
        $produto = Produto::find($id);
        if(!$produto){
            return response()->json('Produto excluido do sistema');
        }
        $produto->delete();
        return response()->json('Exclusão bloqueada');
    }
    public function show($id){
        $produto = Produto::find($id);
        if(!$produto){
            return response()->json('Produto não encontrado');
        }
        return response()->json('Produto encontrado');
    }

}


