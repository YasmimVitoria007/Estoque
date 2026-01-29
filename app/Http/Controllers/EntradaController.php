<?php

namespace App\Http\Controllers;

use App\Models\Entrada;
use App\Models\Produto;
use Illuminate\Http\Request;

class EntradaController extends Controller
{
    public function index()
    {
        $entradas = Entrada::all();
        return response()->json($entradas);
    }

    public function store(Request $request)
    {
        $produto = Produto::find($request->id_produto);

        if (!$produto) {
            return response()->json('Produto não encontrado');
        }

        $entrada = Entrada::create([
            "id_produto" => $request->id_produto,
            "quantidade" => $request->quantidade,
        ]);

        if (isset($entrada)) {
            $produto->quantidade_estoque += $entrada->quantidade;
        }

        $produto->update();

        return response()->json(["mensagem" => "akak"]);
    }

    public function delete($id)
    {
        $entrada = Entrada::find($id);
        if (!$entrada) {
            return response()->json('Entrada não identificada no sistema');
        }

        $produto = $entrada->id_produto;
        $produto->quantidade_estoque = $entrada->quantidade;

        $produto = Produto::find($id);

        if (isset($produto)) {
            $produto->quantidade_estoque -= $entrada->quantidade;
        }
        $produto->update();
        $produto->delete($id);
        return response()->json('Produto deletado');
    }
}
