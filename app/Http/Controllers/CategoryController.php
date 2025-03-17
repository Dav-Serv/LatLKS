<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index()
    {
        $models = Category::paginate(5);
        return Inertia::render('Category/Index', [
            'models' => $models
        ]);
    }

    public function create()
    {
        return Inertia::render('Category/Create', [
            'form_type' => 'POST',
            'title' => 'Create Category',
            'model' => [],
            'route_url' => route('categories.store'),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required',
        ]);

        Category::create($request->only(['name']));

        return redirect()->route('categories.index');
    }

    public function edit(Category $category)
    {
        return Inertia::render('Category/Create', [
            'form_type' => 'PUT',
            'title' => 'Edit Category',
            'model' => $category,
            'route_url' => route('categories.update', $category->id),
        ]);
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name'      => 'required',
        ]);

        $category->update($request->only(['name']));

        return redirect()->route('categories.index');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index');
    }
}
