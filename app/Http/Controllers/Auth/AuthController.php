<?php
namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    //Metodo Para Registrarnos
    public function register(Request $request)
    {
        //valdiar data
        $this->validate($request,
        [ 
            "name"=>"required|max:255",
            "email"=>"required|email|unique:users|max:255",
            "password"=>" required|min:6|confirmed"
        ]);

        $usuario = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
       
        $token = JWTAuth::fromUser($usuario);

        //Estatus 201 indica que se creo un usuario
        return response()->json([
            "usuario"=>$usuario,
            "token"=>$token
        ],201);
    }
    
    public function login(LoginRequest $request)
    {
        $data = $request->only('email','password');
        try {
            if(!$token = JWTAuth::attempt($data))
            {
                return response()->json(
                    [
                        "mensaje"=>"credenciales invalidas"
                    ],400);
            }
            
        } catch (JWTException) {
            return response()->json([
                "error"=>"no creamos el token"
            ],500);
        }

        return response()->json(compact('token'));
    }

}
