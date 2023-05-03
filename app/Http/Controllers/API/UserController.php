<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login(Request $request)
    {
        try {
            // Validate request
            $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);

            //mengecek credentials (login)
            $credentials = request(['email', 'password']);
            if (!Auth::attempt($credentials)) {
                return ResponseFormatter::error([
                    'message' => 'Unauthorized'
                ], 'Authentication Failed', 500);
            }

            // Jika hash tidak sesuai maka beri error
            $user = User::where('email', $request->email)->first();
            if (!Hash::check($request->password, $user->password, [])) {
                throw new \Exception('Invalid Credentials');
            }

            // Jika berhasil maka loginkan
            $tokenResult = $user->createToken('authToken')->plainTextToken;
            return ResponseFormatter::success([
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'user' => $user,
            ], 'Authenticated');

        } catch (\Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error,
            ], 'Authentication Failed', 500);
        }
    }

    public function register(Request $request)
    {
        try {
            // Validate request
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users',
                'password' => 'required|string|confirmed|min:8',
                'password_confirmation' => 'required|string|min:8',
            ]);

            if ($request->password != $request->password_confirmation) {
                return ResponseFormatter::error([
                    'message' => 'Password not match',
                ], 'Authentication Failed', 500);
            }

            // Create user data
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // Get user data
            $user = User::where('email', $request->email)->first();

            // Create token
            $tokenResult = $user->createToken('authToken')->plainTextToken;

            // Return response
            return ResponseFormatter::success([
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'user' => $user,
            ], 'User Registered');

        } catch (\Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error,
            ], 'Authentication Failed', 500);
        }
    }

    public function logout(Request $request)
    {
        // Get user data
        $token = $request->user()->currentAccessToken()->delete();

        // Return response
        return ResponseFormatter::success($token, 'Token Revoked');
    }

    public function updatePassword(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'current_password' => 'required',
            'password' => 'required|string|confirmed|min:8',
            'password_confirmation' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $validator->errors(),
            ], 'Update Password Failed', 500);
        }

        $user = Auth::user();

        if (!Hash::check($data['current_password'], $user->password, [])) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $validator->errors(),
            ], 'Update Password Failed', 500);
        }

        $user->password = Hash::make($data['password']);
        $user->save();

        return ResponseFormatter::success([
            'user' => $user,
        ], 'Update Password Success');
        

    }
}
