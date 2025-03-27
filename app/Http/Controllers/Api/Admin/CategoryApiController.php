<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\PostResource;

class CategoryApiController extends Controller
{
    public function index(){
        $models = Category::paginate(5);

        return new PostResource(true, 'List Data Category', $models);
    }

    public function show($category){
        $models = Category::find($category);
        return new PostResource(true, 'Data Category', $models);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            // return response()->json($validator->errors(), 422);
            return new PostResource(false, $validator->errors()->toArray(), []);
        }

        $models = Category::create($request->all());
        return new PostResource(true, 'Insert Data Category', $models);
    }

    public function update(Request $request, $category){
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            // return response()->json($validator->errors(), 422);
            return new PostResource(false, $validator->errors()->toArray(), []);
        }

        $models = Category::find($category)->update($request->all());

        // $models = Category::update($request->all());
        return new PostResource(true, 'Update Data Category', $models);
    }

    public function destroy($category){
        $models = Category::find($category)->delete();

        return new PostResource(true, 'Update Data Category', $models);
    }
}
