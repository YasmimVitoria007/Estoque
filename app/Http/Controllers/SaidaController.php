<?php

namespace App\Http\Controllers;

use App\Models\Entrada;
use App\Models\Saida;
use Illuminate\Http\Request;

class SaidaController extends Controller
{
    public function index()
    {
        $saidas = Saida::all();
        return response()->json($saidas);
    }

    public function store(Request $request)
    {
        $saida = Saida::create([
            "id_cliente" => $request->id_produto,
            "id_produto" => $request->id_produto,
            "quantidade" => $request->quantidade,
        ]);

        return response()->json($saida);
    }

    public function delete($id)
    {
        $saida = Saida::find($id);
        if (!$saida) {
            return response()->json('Saida não identificada no sistema');
        }
        $saida->delete();
        return response()->json('Exclusão bloqueada');
    }
}
