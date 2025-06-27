<?php

namespace App\Http\Controllers;

use App\Models\Lista;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ListaController extends Controller
{
    private $model;

    public function __construct(Lista $model)
    {
        $this->model = $model;
    }

    public function index(): JsonResponse
    {

        $lista = $this->model->all();

        if(!$lista) {
            return response()->json([
                'message' => 'Sem lista cadastrada'
            ]);
        }

        return response()->json([
            'message' => 'Listas:',
            'data' => $lista
        ]);
    }

    public function create(Request $request): JsonResponse
    {
        $dados = $request->all();
        
        $lista = $this->model->create($dados);

        return response()->json([
            'message' => 'Lista criada com sucesso',
            'data' => $lista
        ]);
    }

    public function show($id): JsonResponse
    {
        $lista = $this->model->find($id);

        if(!$lista) {
            return response()->json([
                'message' => 'Essa lista nao existe ou nao foi encontrada'
            ]);
        }

        return response()->json([
            'message' => 'Lista:',
            'data' => $lista
        ]);
    }

    public function update($id, Request $request): JsonResponse
    {
        $lista = $this->model->find($id);

        if(!$lista) {
            return response()->json([
                'message' => 'Lista nao encontrada'
            ]);
        }

        $lista->update($request->all());

        return response()->json([
            'message' => 'Lista editade com sucesso',
            'data' => $lista
        ]);

    }   

    public function destroy($id): JsonResponse
    {
        $lista = $this->model->find($id);

        if(!$lista) {
            return response()->json([
                'message' => 'lista nao encontrada'
            ]);
        }

        return response()->json([
            'message' => 'Lista deletada com sucesso',
            'data' => $lista
        ]);
    }

}
