<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Table;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\PostResource;

class TableApiController extends Controller
{
    public function index(){
        $models = Table::paginate(5);
        return new PostResource(true, 'List Data Table', $models);
    }

    public function show($table){
        $models = Table::find($table);
        return new PostResource(true, 'Data Table', $models);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|max:255',
            'location'  => 'required|string|max:255',
            'limit'     => 'required|numeric',
            'price'     => 'required|numeric',
            'status'    => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            // return response()->json($validator->errors(), 422);
            return new PostResource(false, $validator->errors()->toArray(), []);
        }

        $models = Table::create($request->all());
        return new PostResource(true, 'Insert Data Table', $models);
    }

    public function update(Request $request, $table){
        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|max:255',
            'location'  => 'required|string|max:255',
            'limit'     => 'required|numeric',
            'price'     => 'required|numeric',
            'status'    => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            // return response()->json($validator->errors(), 422);
            return new PostResource(false, $validator->errors()->toArray(), []);
        }

        $models = Table::find($table)->update($request->all());

        // $models = Table::update($request->all());
        return new PostResource(true, 'Update Data Table', $models);
    }

    public function destroy($table){
        $models = Table::find($table)->delete();

        return new PostResource(true, 'Update Data Table', $models);
    }
}
