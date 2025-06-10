<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    private $model;

    public function __construct(Categoria $model)
    {   
        $this->model = $model;
    }

    public function index(): JsonResponse
    {
        $categoria = $this->model->all();

        if($categoria->isEmpty()) {
            return response()->json([
                'message' => 'Sem categoria'
            ]);
        }

        return response()->json([
            'message' => 'Lista de categoria',
            'categoria' => $categoria
        ]);
    }
    public function create(Request $request): JsonResponse
    {
        $categoria = Categoria::create($request->all());

        return response()->json([
           'message' => 'Categoria creada com sucesso',
           'data' => $categoria 
        ]);

    }

    public function update($id, Request $request): JsonResponse
    {
        $this->model->findOrFail($id)->update($request->all());

        return response()->json([
           'message' => 'Categoria editada com sucesso',
        ]);
    }

    public function destroy($id)
    {
        
        $this->model->findOrFail($id)->delete();

        return response()->json([
           'message' => 'Categoria deletada com sucesso',
        ]);
    }
}
