<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;

class ApiCategoryController extends Controller
{
    public function index() {
        $categories = Category::all();

        return response()->json($categories);
    }

    public function show($id) {
        $category = Category::find($id);

        return response()->json($category);
    }
}
