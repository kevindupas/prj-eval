<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class ApiBrandController extends Controller
{
    public function index() {
        $brands = Brand::all();

        return response()->json($brands);
    }

    public function show($id) {
        $brand = Brand::find($id);

        return response()->json($brand);
    }

    public function getProductsByBrand(Request $request, $brandId) {
        $query = Brand::findOrFail($brandId)->product();

        if  ($request->has('category_id')) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('categories.id', $request->category_id);
            });
        }

        $products = $query->get();

        return response()->json($products);
    }
}
