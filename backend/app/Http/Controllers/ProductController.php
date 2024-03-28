<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Str;

class ProductController extends Controller
{
    public function index() {
        $products = Product::all();

        return Inertia::render('Admin/Products/List', [
            'products' => $products
        ]);
    }

    public function create() {
        return Inertia::render('Admin/Products/Create');
    }


    public function store(ProductRequest $request) {
        $product = new Product();
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->label = $request->input('label');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $shortName = Str::slug($request->input('name'));
            $imageName = $shortName . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public', 'images/products/' . $imageName);
            $product->image = '/storage/images/products/' . $imageName;
        }

        $product->save();

        return redirect()->route('products.index')->with('message', 'Product created successfully.');
    }


    public function show() {
    }

    public function edit(Product $product) {
        return Inertia::render('Admin/Products/Edit', [
            'product' => $product
        ]);
    }

    public function update(ProductRequest $request, Product $product)
    {
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->label = $request->input('label');

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Supprime l'image existante
            Storage::disk('public')->delete(str_replace('/storage', '', $product->image));

            // Enregistre la nouvelle image
            $image = $request->file('image');
            $shortName = Str::slug($request->input('name'));
            $imageName = $shortName . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public', 'images/products/' . $imageName);
            $product->image = '/storage/images/products/' . $imageName;
        }

        $product->save();

        return redirect()->route('products.index')->with('message', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('message', 'Product deleted successfully.');
    }
}
