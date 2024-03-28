<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index() {
        $products = Product::all();

        return Inertia::render('Admin/Products/List', [
            'products' => $products
        ]);
    }

    public function create() {

        $categories = Category::all();
        $brands = Brand::all();

        return Inertia::render('Admin/Products/Create', [
            'categories' => $categories,
            'brands' => $brands
        ]);
    }


    public function store(ProductRequest $request) {
        $product = new Product();
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->label = $request->input('label');
        $product->brand_id = $request->input('brand_id');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $shortName = Str::slug($request->input('name'));
            $imageName = $shortName . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public', 'images/products/' . $imageName);
            $product->image = '/storage/images/products/' . $imageName;
        }

        $categoriesIds = $request->input('categories');
        $product->categories()->sync($categoriesIds);

        $product->save();

        return redirect()->route('products.index')->with('message', 'Product created successfully.');
    }


    public function show() {
    }

    public function edit(Product $product) {

        $categories = Category::all();
        $brands = Brand::all();

        return Inertia::render('Admin/Products/Edit', [
            'product' => $product,
            'categories' => $categories,
            'brands' => $brands
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

        $categoriesIds = $request->input('categories');
        $product->categories()->sync($categoriesIds);

        $product->save();

        return redirect()->route('products.index')->with('message', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('message', 'Product deleted successfully.');
    }
}
