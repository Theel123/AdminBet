<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    public function index(): JsonResponse 
    {
        $categories = Category::get();
        
        return response()->json($categories, 200);
    }

    public function show($id): JsonResponse 
    {
        try {
            $category = Category::where('id', $id)->firstOrFail();
            
            return response()->json($category, 200);
        } catch (Exception $e) {

            return response()->json('Erro ao selecionar categoria', 400);
        }
    }

    public function store(Request $request): JsonResponse 
    {
        $request = $request->all();

        $category = Category::create($request);

        return response()->json($category, 200);
    }

    public function destroy($id): JsonResponse 
    {
        $category = Category::destroy($id);

        if ($category === 0) {
            return response()->json("Categoria não encontrada", 400);
        }

        return response()->json("Categoria $id excluida com sucesso", 200);
    }

    public function update($id, Request $request): JsonResponse 
    {
        $request = $request->all();

        $category = Category::fill($request);
        $category = Category::create($category);

        return response()->json('$category', 200);
    }
}
