<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where("email", $request->email)->first();
        if(!$user || !Hash::check($request->password, $user->password)){
            return response()->json([
                "error" => "Invalid credentials"
            ], 400);
        }
        return $user->createToken($user->email)->plainTextToken;
    }
    public function register(Request $request)
    {
        $user = User::where("email", $request->email)->first();
        if($user){
            return response()->json(["error" => "A user with the given email already exists in the database."], 400);
        }
        try{
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            return $user->createToken($user->email)->plainTextToken;
        } catch (Exception $ex){
            return response()->json([
                "error" => $ex->getMessage()
            ], 500);
        }
    }
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->noContent();
    }
}
