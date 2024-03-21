<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();

        return Inertia::render('Admin/Categories/List', [
            'categories' => $categories
        ]);
    }

        /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Categories/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $category = new Category();
        $category->name = $request->input('name');
        $category->description = $request->input('description');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $shortName = Str::slug($request->input('name'));
            $imageName = $shortName . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public', 'images/categories/' . $imageName);
            $category->image = '/storage/images/categories/' . $imageName;
        }

        $category->save();

        return redirect()->route('categories.index')->with('message', 'Category created successfully.');
    }

    public function edit(Category $category)
    {
        return Inertia::render('Admin/Categories/Edit', [
            'category' => $category
        ]);
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $category->name = $request->input('name');
        $category->description = $request->input('description');

        if ($request->hasFile('iamge') && $request->file('image')->isValid()) {
            // Supprime l'image existante
            Storage::disk('public')->delete(str_replace('/storage', '', $category->image));

            // Enregistre la nouvelle image
            $image = $request->file('image');
            $shortName = Str::slug($request->input('name'));
            $imageName = $shortName . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public', 'images/categories/' . $imageName);
            $category->image = '/storage/images/categories/' . $imageName;
        }

        $category->save();

        return redirect()->route('admin.poi-categories.index')->with('message', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('message', 'Category deleted successfully.');
    }
}
