<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class BookController extends Controller
{
    protected $model;

    public function __construct(Book $model)
    {
        $this->model = $model;
    }

    public function index():JsonResponse
    {
        $book = $this->model->all();

        if($book->isEmpty()) {
            return response()->json([
                'message' => 'Nao tem livro cadastrado'
            ]);
        }

        return response()->json([
            'message' => 'LIsta de livro',
            'data' => $book
        ]);
    }

    public function create(Request $request): JsonResponse 
    {
        $book = $this->model->create($request->all());

        return response()->json([
            'message' => 'Livro cadastrado com sucesso',
            'data' => $book
        ]);
    }

    public function show($id): JsonResponse
    {
        $book = $this->model->findOrFail($id);

        return response()->json([
            'data' => $book
        ]);
    }

    public function update($id, Request $request): JsonResponse
    {
        $book = $this->model->findOrFail($id)->update($request->all());

        return response()->json([
            'message' => 'Usuario editado com sucesso',
            'data' => $book
        ]);
    }

    public function destroy($id): JsonResponse
    {
        $this->model->findOrfail($id)->delete();

        return response()->json([
            'message' => 'Livro deletado com sucesso'
        ]);
    }
}
