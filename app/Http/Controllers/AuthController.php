<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use Exception;


class AuthController extends Controller
{

    public function facebook(Request $request)
    {
        $request->validate([
            'access_token' => 'required',
        ]);

        try {
            $user = Socialite::driver('facebook')->userFromToken($request->access_token);
        } catch (Exception $e) {

            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Use $user data to authenticate user or create new user

        return response()->json(['user' => $user]);
    }

    public function facebookCallback(Request $request)
    {
        $request->validate([
            'code' => 'required',
        ]);

        try {
            $user = Socialite::driver('facebook')->user();
        } catch (Exception $e) {

            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Use $user data to authenticate user or create new user

        return response()->json(['user' => $user]);
    }


    public function google(Request $request)
    {
        $request->validate([
            'access_token' => 'required',
        ]);

        try {
            $user = Socialite::driver('google')->userFromToken($request->access_token);
        } catch (Exception $e) {

            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Use $user data to authenticate user or create new user

        return response()->json(['user' => $user]);
    }

    public function googleCallback(Request $request)
    {
        $request->validate([
            'code' => 'required',
        ]);

        try {
            $user = Socialite::driver('google')->user();
        } catch (Exception $e) {

            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Use $user data to authenticate user or create new user

        return response()->json(['user' => $user]);
    }
}
