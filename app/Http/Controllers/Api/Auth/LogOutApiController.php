<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PostResource;
use App\Models\User;

class LogOutApiController extends Controller
{
    public function logout(){
        try{
            if(Auth::user()->tokens()->delete()) {
                return new PostResource(false, 'Berhasil LogOut!', []);
            }
            return new PostResource(true, 'Terjadi Kesalahan!', []);
        }catch(\Exception $e){
            return new PostResource(false, "Caught exception: {$e->getMessage()}", []);
        }
    }
}
