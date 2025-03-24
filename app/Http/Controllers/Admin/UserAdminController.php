<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;

class UserAdminController extends Controller
{
    public function index(){
        $models = User::paginate(5);
        return Inertia::render('User/Index', [
            'models' => $models
        ]);
    }

    public function create()
    {
        return Inertia::render('User/Create', [
            'form_type' => 'POST',
            'title' => 'Create User',
            'model' => [],
            'route_url' => route('user.store'),
        ]);
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'name'      => 'required|max:150',
        //     'location'      => 'required',
        //     'limit'      => 'required',
        //     'price'      => 'required',
        //     'status'    => 'required|in:active,inactive',
        // ]);

        User::create($request->all());

        return redirect()->route('user.index');
    }

    public function edit(User $user)
    {
        return Inertia::render('User/Create', [
            'form_type' => 'PUT',
            'title' => 'Edit User',
            'model' => $user,
            'route_url' => route('user.update', $user->id),
        ]);
    }

    public function update(Request $request, User $user)
    {
        // $request->validate([
        //     'name'      => 'required|max:150',
        //     'location'      => 'required',
        //     'limit'      => 'required',
        //     'price'      => 'required',
        //     'status'    => 'required|in:active,inactive',
        // ]);

        $user->update($request->all());

        return redirect()->route('user.index');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('user.index');
    }
}
