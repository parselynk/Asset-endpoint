<?php

namespace App\Http\Controllers;

use App\Asset;
use Illuminate\Http\Request;

class AssetsController extends Controller
{
    public function index()
    {
         
        if (auth()->user()->isAdmin()) {
            $assets = Asset::all()->toArray();
            return response()->json($assets, 200);
        }
        
        $assets = auth()->user()->assets()->toArray();
        return response()->json($assets, 200);
    }
}
