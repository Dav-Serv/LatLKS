<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TableController extends Controller
{
    public function index()
    {
        $models = Table::paginate(5);
        return Inertia::render('Table/Index', [
            'models' => $models
        ]);
    }

    public function create()
    {
        return Inertia::render('Table/Create', [
            'form_type' => 'POST',
            'title' => 'Create Table',
            'model' => [],
            'route_url' => route('tables.store'),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|max:150',
            'desc'      => 'required',
            'status'    => 'required|in:active,inactive',
        ]);

        Table::create($request->only(['name', 'desc', 'status']));

        return redirect()->route('tables.index');
    }

    public function edit(Table $table)
    {
        return Inertia::render('Table/Create', [
            'form_type' => 'PUT',
            'title' => 'Edit Table',
            'model' => $table,
            'route_url' => route('tables.update', $table->id),
        ]);
    }

    public function update(Request $request, Table $table)
    {
        $request->validate([
            'name'      => 'required|max:150',
            'desc'      => 'required',
            'status'    => 'required|in:active,inactive',
        ]);

        $table->update($request->only(['name', 'desc', 'status']));

        return redirect()->route('tables.index');
    }

    public function destroy(Table $table)
    {
        $table->delete();

        return redirect()->route('tables.index');
    }
}
