<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ApiServiceController extends Controller
{
    public function index() {

        $services = Service::all();

        return response()->json($services);
    }

    public function show($id) {
        $service = Service::find($id);

        return response()->json($service);
    }
}
