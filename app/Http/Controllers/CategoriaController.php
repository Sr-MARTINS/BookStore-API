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
        dd($categoria);

        if(!$categoria) {
            return response()->json([
                'message' => 'Categorias nao encontrada'
            ]);
        }

        return response()->json([
            'message' => 'Lista de categoria',
            'data' => $categoria
        ]);
    }
}
