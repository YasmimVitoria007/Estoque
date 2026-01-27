<?php

namespace App\Http\Controllers;

use App\Models\Entrada;
use Illuminate\Http\Request;

class EntradaController extends Controller
{
     public function index(){
        $entradas = Entrada::all();
        return response()->json($entradas);
     }

      public function store(Request $request){
        $entrada = Entrada::create([
            "quantidade"=> $request->quantidade,
            "id_produto"=> $request->id_produto,
        ]);

        return response()->json($entrada);

    }

       public function delete($id)
    {
        $entrada = Entrada::find($id);
        if (!$entrada) {
            return response()->json('Entrada não identificada no sistema');
        }
        $entrada->delete();
        return response()->json('Exclusão bloqueada');
    }

}
