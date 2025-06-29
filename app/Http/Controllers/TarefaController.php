<?php

namespace App\Http\Controllers;

use App\Models\Lista;
use App\Models\Tarefa;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TarefaController extends Controller
{
    private $model;

    public function __construct(Tarefa $model)
    {
        $this->model = $model;
    }

    public function index($lista_id): JsonResponse
    {
        $tarefas = $this->model->where('lista_id', $lista_id)->get();

        if($tarefas->isEmpty()) {
            return response()->json([
                'message' => 'Essa lista nao existe ou nao foi encontrada'
            ]);
        }

        return response()->json([
            'message' => 'Tarefas da lista '. $lista_id,
            'data' => $tarefas
        ]);
    }

    public function create(Request $request): JsonResponse
    {
        $dados = $request->all();
        
        // $lista = Lista::where('id', $dados['lista_id'])->get();

        // if(!$lista) {
        //     return response()->json([
        //         'message' => 'Lista na encontrada'
        //     ]);
        // }
        // echo "cheou aq";
        // exit;
        $tarefa = $this->model->create($dados);

        return response()->json([
            'message' => 'Tarefa criado com sucesso',
            'data' => $tarefa
        ]);
    }

    public function show($lista_id, $id): JsonResponse
    {
        $lista = $this->model->findOrFail($lista_id);

        if(!$lista) {
            return response()->json([
                'message' => 'Lista nao encontrada'
            ]);
        }

        $tarefa = $this->model->findOrFail($id);

        if(!$tarefa) {
            return response()->json([
                'message' => 'Essa tarefa nao existe ou nao foi encontrado'
            ]);
        }

        return response()->json([
            'message' => 'Tarefa:',
            'data' => $tarefa
        ]);
    }

    public function update($id, Request $request): JsonResponse
    {
        $tarefa = $this->model->find($id);

        if(!$tarefa) {
            return response()->json([
                'message' => 'Tarefa nao encontrado'
            ]);
        }

        $tarefa->update($request->all());

        return response()->json([
            'message' => 'Tarefa editado com sucesso',
            'data' => $tarefa
        ]);

    }   

    public function destroy($id): JsonResponse
    {
        $tarefa = $this->model->find($id);

        if(!$tarefa) {
            return response()->json([
                'message' => 'Tarefa nao encontrado'
            ]);
        }
        
        $tarefa->delete();

        return response()->json([
            'message' => 'Tarefa deletado com sucesso',
            'data' => $tarefa
        ]);
    }
}
