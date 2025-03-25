<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $models = Product::all();
        return Inertia::render('Dashboard', [
            'name'      => Auth::user()->name,
            'models'    => $models
        ]);
    }

    public function show($product){
        $models = Product::with('category')->findOrFail($product);

        return Inertia::render('Dashboard/Show', [
            'models'    => $models
        ]);
    }
}
