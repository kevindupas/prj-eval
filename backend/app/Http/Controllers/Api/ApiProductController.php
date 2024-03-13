<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ApiProductController extends Controller
{
    public function index() {
        $products = Product::all();

        return response()->json($products);
    }

    public function show($id) {
        $product = Product::find($id);

        return response()->json($product);
    }

    public function getProductByCategory($id) {
        $category = Category::find($id);

        $products = $category->product()->orderBy('id', 'asc')->get();

        return response()->json($products);
    }
}
