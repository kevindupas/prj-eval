<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $servcies = Service::all();

        return Inertia::render('Admin/Services/List', [
            'services' => $servcies
        ]);
    }

        /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Services/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ServiceRequest $request)
    {
        $service = new Service();
        $service->name = $request->input('name');
        $service->description = $request->input('description');
        $service->price = $request->input('price');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $shortName = Str::slug($request->input('name'));
            $imageName = $shortName . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public', 'images/services/' . $imageName);
            $service->image = '/storage/images/services/' . $imageName;
        }

        $service->save();

        return redirect()->route('services.index')->with('message', 'Service created successfully.');
    }

    public function edit(Service $service)
    {
        return Inertia::render('Admin/Services/Edit', [
            'service' => $service
        ]);
    }

    public function update(ServiceRequest $request, Service $service)
    {
        $service->name = $request->input('name');
        $service->description = $request->input('description');
        $service->price = $request->input('price');

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Supprime l'image existante
            Storage::disk('public')->delete(str_replace('/storage', '', $service->image));

            // Enregistre la nouvelle image
            $image = $request->file('image');
            $shortName = Str::slug($request->input('name'));
            $imageName = $shortName . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public', 'images/services/' . $imageName);
            $service->image = '/storage/images/services/' . $imageName;
        }

        $service->save();

        return redirect()->route('services.index')->with('message', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('services.index')->with('message', 'Service deleted successfully.');
    }
}