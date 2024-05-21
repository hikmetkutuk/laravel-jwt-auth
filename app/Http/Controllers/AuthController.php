<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|string|max:255",
            "email" => "required|string|email|max:255|unique:users",
            "password" => "required|string|min:6|confirmed",
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                "message" => "Validation errors",
                "errors" => $validator->errors()
            ], 422);
        }

        try {
            $user = User::create([
                "name" => $request->name,
                "email" => $request->email,
                "password" => Hash::make($request->password)
            ]);

            return response()->json([
                "status" => true,
                "message" => "User created successfully",
                "data" => $user
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "message" => "User creation failed",
                "error" => $e->getMessage()
            ], 500);
        }
    }

    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            "email" => "required|email",
            "password" => "required",
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                "message" => "Validation errors",
                "errors" => $validator->errors()
            ], 422);
        }

        try {
            if (!$token = JWTAuth::attempt($request->only('email', 'password'))) {
                return response()->json([
                    "status" => false,
                    "message" => "Invalid login details"
                ], 401);
            }

            return response()->json([
                "status" => true,
                "message" => "User logged in successfully",
                "data" => $token
            ]);
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "message" => "Could not create token",
                "error" => $e->getMessage()
            ], 500);
        }
    }

    public function profile(): JsonResponse
    {
        try {
            $userData = auth()->user();

            return response()->json([
                "status" => true,
                "message" => "User profile",
                "data" => $userData
            ]);
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "message" => "Failed to retrieve user profile",
                "error" => $e->getMessage()
            ], 500);
        }
    }

    public function refreshToken(): JsonResponse
    {
        try {
            $token = JWTAuth::parseToken()->refresh();

            return response()->json([
                "status" => true,
                "message" => "New access token generated",
                "data" => $token
            ]);
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "message" => "Failed to refresh token",
                "error" => $e->getMessage()
            ], 500);
        }
    }

    public function logout(): JsonResponse
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());

            return response()->json([
                "status" => true,
                "message" => "User logged out successfully"
            ]);
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "message" => "Failed to log out",
                "error" => $e->getMessage()
            ], 500);
        }
    }
}
