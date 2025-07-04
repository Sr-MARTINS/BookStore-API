<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    private $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function index(): JsonResponse 
    {
        $user = $this->model->all();
        
        // if(!empty($user)) {
        //     return response()->json([
        //         'message' => 'Nenhum usuario encontrado'
        //     ]);
        // }

        return response()->json([
            'message' => 'Lista de usuarios',
            'data' => $user
        ]);
    }

    public function create(UserRequest $request): JsonResponse
    {
        $dados = $request->only(['name', 'email', 'password']);

        if (User::where('name', $request->name)->exists()) {
            return response()->json([
                'message' => 'O name já está em uso.',
            ], 400);
        }

        if (User::where('email', $request->email)->exists()) {
            return response()->json([
                'message' => 'O e-mail já está em uso.',
            ], 400);
        }

        $user = $this->model->create($dados);

        return response()->json([
            'message' => 'Usuario creado com sucesso',
            'data' => $user
        ]);
    }

    public function show($id): JsonResponse
    {
        $user = $this->model->find($id);

        if(!$user) {
            return response()->json([
                'message' => 'Usuario nao encontrado'
            ], 404);
        }

        return response()->json([
            'message' => 'Usuario:',
            'data' => $user
        ]);
    }

    public function update($id, UserRequest $request): JsonResponse
    {
        $user = $this->model->find($id);

        if(!$user) {
            return response()->json([
                'message' => 'Usuario nao encontrado'
            ], 404);
        }

        $user->update($request->all());

        return response()->json([
            'message' => 'Usuario editado com sucesso',
            'data' => $user
        ]);
    }

    public function destroy($id): JsonResponse
    {
        $user = $this->model->find($id);
    
        if(!$user) {
            return response()->json([
                'message' => 'Usuario nao encontrado'
            ], 404);
        }

        return response()->json([
            'message' => 'Usuario deletado com sucesso',
            'data' => $user
        ]);
    }
}
