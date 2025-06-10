<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use Illuminate\Support\Facades\Hash;
use function PHPUnit\Framework\isEmpty;

class UsuarioController extends Controller
{
    public function index(): JsonResponse
    {
        $user = User::all();

        if($user->isEmpty()) {
            return response()->json([
                'message' => 'Listagem sem usuario'
            ]);    
        }

        return response()->json([
            'message' => 'Listagem de usuarios',
            'user' => $user
        ], 200);
    }

    public function create(Request $request): JsonResponse
    {
        if(User::where('name', $request->name)->exists()) {
            return response()->json([
                'message' => "Nome ja esta em uso"
            ], 409);
        }

        if(User::where('email', $request->email)->exists()) {
            return response()->json([
                'message' => "E-mail ja esta em uso"
            ], 409);
        }

        $user = User::create($request->all());

        return response()->json([
            'message' => 'Usuario creado com sucesso',
            'user' => $user
        ]);
    }

    public function show($id) 
    {
        $user = User::find($id);

        if(!$user) {
            return response()->json([
                'message' => 'Usuario nao encontraddo'
            ]);
        }

        return response()->json([
            'user' => $user->only(['id', 'name', 'email'])
        ]);
    }

    public function update($id, Request $request): JsonResponse
    {
        $user = User::findOrFail($id);
        $dados = $request->only(['name', 'email', 'password']);
        if(isset($dados['password'])) {
            $dados['password'] = Hash::make($dados['password']);
        }

        $user->update($dados);

        return response()->json([
            'message' => 'Usuario editado com sucesso',
            'user' => $user
        ]);
    }

    public function destroy($id): JsonResponse
    {
        $user = User::findOrFail($id);

        $user->delete();

        return response()->json([
            'message' => 'Usuario deletado com sucesso',
            'user' => $user
        ]);
    }
}
