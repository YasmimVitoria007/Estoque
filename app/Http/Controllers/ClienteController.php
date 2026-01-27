<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all();
        return response()->json($clientes);
    }
    public function store(Request $request)
    {
        $verificacao = Cliente::where('cpf', '=', $request->cpf)->first();

        if ($verificacao == null) {
            $cliente = Cliente::create([
                'nome' => $request->nome,
                'cpf' => $request->cpf,
                'idade' => $request->idade,
            ]);
            return response()->json($cliente);
        } else {
            return response()->json(" O cpf jã está sendo usado ");
        }
    }
    public function update($id)
    {
        $clientes = Cliente::find($id);
        if (!$clientes) {
            return response()->json('Cliente não encontrado');
        }
        if (isset($request->nome)) {
            $clientes->nome = $request->nome;
        }
        if (isset($request->cpf)) {
            $clientes->cpf = $request->cpf;
        }
        if (isset($request->idade)) {
            $clientes->idade = $request->idade;
        }

        $clientes->update();
        return response()->json('Dados atualizados');
    }

    public function delete($id)
    {
        $cliente = Cliente::find($id);
        if (!$cliente) {
            return response()->json('Cliente excluido do sistema');
        }
        $cliente->delete();
        return response()->json('Exclusão bloqueada');
    }

    public function show($id)
    {
        $cliente = Cliente::find($id);
        if (!$cliente) {
            return response()->json('Especialidade não encontrada');
        }
        return response()->json('Especialidade encontrada');
    }
}
