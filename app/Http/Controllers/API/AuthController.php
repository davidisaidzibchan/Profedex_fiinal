<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return response(Response::HTTP_CREATED);
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return response([
                "user" => [
                    "id" => $user->id,
                    "name" => $user->name,
                    "username" => $user->username,
                    "email" => $user->email,
                ]
            ], Response::HTTP_OK);
        } else {
            return response(["message" => "credenciales invalidas"], Response::HTTP_UNAUTHORIZED);
        }
    }


    public function logout(Request $request)
    {
        $cookie = Cookie::forget('cookie_token');
        return response(["message" => "cierre de sesión OK"], Response::HTTP_OK)->withCookie($cookie);
    }
}
