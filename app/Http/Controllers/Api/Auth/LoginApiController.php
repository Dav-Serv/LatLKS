<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PostResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginApiController extends Controller
{
    public function login(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'email'     => ['required', 'email', 'string'],
                'password'  => ['required', 'min:8'],
            ]);

            if($validator->fails()) {
                return new PostResource(false, $validator->errors()->toArray(), []);
            }

            if($user = User::where('email', $request->email)->first()){
                if(Hash::check($request->password, $user->password)){
                    $response =[
                        'name'      => $user->name,
                        'email'     => $user->email,
                        'token'     => $user->createToken($user->id)->plainTextToken,
                    ];
                    return new PostResource(true, 'Berhasil Login!', $response);
                }
            }
            return new PostResource(false, 'Pengguna Tidak Ditemukan!', []);
        }catch(\Exception $e){
            return new PostResource(false, "Caught exception: {$e->getMessage()}", []);
        }
    }
}
