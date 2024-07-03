<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Providers;
use Illuminate\Http\Request;

class ProvidersController extends Controller
{
    public function index() 
    {
        $providers = Providers::get();

        return response()->json($providers, 200);
    }
}
