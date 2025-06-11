<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Categoria;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
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
        $books = $this->model->with(['categorias:id,name'])
        ->select('id', 'title', 'descricao','autor')
        ->get();

        if($books->isEmpty()) {
            return response()->json([
                'message' => 'Nao tem livro cadastrado'
            ]);
        }

        return response()->json([
            'message' => 'LIsta de livro',
            'data' => $books, 
        ]);
    }

    public function create(Request $request): JsonResponse 
    {
        $categoria = Categoria::findOrFail($request->categoria_id);

        if(!$categoria) {
            return response()->json([
                'message' => 'Categoria nao encontrada'
            ]);
        }

        // $book = $this->model->create($request->only(['title', 'descricao', 'autor']));
        $book = $this->model->create(Arr::except($request->all(), ['categoria_id']));

        // Relaciona com a(s) categoria(s)
        if ($request->has('categoria_id')) {
            $book->categorias()->sync($request->categoria_id); // passa como array
        }

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
