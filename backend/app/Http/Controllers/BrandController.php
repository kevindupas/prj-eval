<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::all();

        return Inertia::render('Admin/Brands/List', [
            'brands' => $brands
        ]);
    }

        /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Brands/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandRequest $request)
    {
        $brand = new Brand();
        $brand->name = $request->input('name');
        $brand->description = $request->input('description');
        $brand->partner = $request->input('partner');

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $shortName = Str::slug($request->input('name'));
            $logoName = $shortName . '.' . $logo->getClientOriginalExtension();
            $logo->storeAs('public', 'images/brands/' . $logoName);
            $brand->image = '/storage/images/brands/' . $logoName;
        }

        $brand->save();

        return redirect()->route('brands.index')->with('message', 'Brand created successfully.');
    }

    public function edit(Brand $brand)
    {
        return Inertia::render('Admin/Brands/Edit', [
            'brand' => $brand
        ]);
    }

    public function update(BrandRequest $request, Brand $brand)
    {
        $brand->name = $request->input('name');
        $brand->description = $request->input('description');

        if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
            // Supprime l'logo existante
            Storage::disk('public')->delete(str_replace('/storage', '', $brand->logo));

            // Enregistre la nouvelle logo
            $logo = $request->file('logo');
            $shortName = Str::slug($request->input('name'));
            $logoName = $shortName . '.' . $logo->getClientOriginalExtension();
            $logo->storeAs('public', 'images/brands/' . $logoName);
            $brand->image = '/storage/images/brands/' . $logoName;
        }

        $brand->save();

        return redirect()->route('brands.index')->with('message', 'Brand updated successfully.');
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();

        return redirect()->route('brands.index')->with('message', 'Brand deleted successfully.');
    }
}
