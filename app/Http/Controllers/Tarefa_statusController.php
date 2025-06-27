<?php

namespace App\Http\Controllers;

use App\Models\Tarefa_status;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class Tarefa_statusController extends Controller
{
    private $model;

    public function __construct(Tarefa_status $model)
    {
        $this->model = $model;
    }

    public function index(): JsonResponse
    {
        $status = $this->model->all();

        if(!$status) {
            return response()->json([
                'message' => 'Sem status cadastrado'
            ]);
        }

        return response()->json([
            'message' => 'Lista de status:',
            'data' => $status
        ]);
    }

    public function create(Request $request): JsonResponse
    {
        $dados = $request->all();
        
        $status = $this->model->create($dados);

        return response()->json([
            'message' => 'Status criado com sucesso',
            'data' => $status
        ]);
    }

    public function show($id): JsonResponse
    {
        $status = $this->model->find($id);

        if(!$status) {
            return response()->json([
                'message' => 'Essa status nao existe ou nao foi encontrado'
            ]);
        }

        return response()->json([
            'message' => 'Status:',
            'data' => $status
        ]);
    }

    public function update($id, Request $request): JsonResponse
    {
        $status = $this->model->find($id);

        if(!$status) {
            return response()->json([
                'message' => 'Status nao encontrado'
            ]);
        }

        $status->update($request->all());

        return response()->json([
            'message' => 'Status editado com sucesso',
            'data' => $status
        ]);

    }   

    public function destroy($id): JsonResponse
    {
        $status = $this->model->find($id);

        if(!$status) {
            return response()->json([
                'message' => 'status nao encontrado'
            ]);
        }
        
        $status->delete();

        return response()->json([
            'message' => 'Status deletado com sucesso',
            'data' => $status
        ]);
    }
}
