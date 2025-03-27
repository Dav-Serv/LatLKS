<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PostResource;
use App\Models\User;

class RegisterApiController extends Controller
{
    public function register(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'name'      =>['required', 'string', 'max:255'],
                'email'     =>['required', 'email', 'unique:users,email'],
                'password'  =>['required', 'min:8', 'confirmed'],
            ]);

            if($validator->fails()){
                return new PostResource(false, $validator->errors()->toArray(), []);
            }

            if($user = User::create([
                'name'      => $request->name,
                'email'     => $request->email,
                'level'     => 'user',
                'password'  => $request->password,
            ])){
                $response =[
                    'name'      => $user->name,
                    'email'     => $user->email,
                    'level'     => $user->level,
                    'password'  => $user->password,
                    'token'     => $user->createToken($user->id)->plainTextToken,
                ];
                return new PostResource(true, 'Berhasil Mendaftar!', $response);
            }
        }catch(\Exception $e){
            return new PostResource(false, "Caught exception: {$e->getMessage()}", []);
        }
    }
}
