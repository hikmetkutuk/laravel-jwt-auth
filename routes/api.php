<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

/**
 * @OA\OpenApi(
 *     @OA\Info(
 *         title="Your API Title",
 *         version="1.0.0",
 *         description="API documentation for your application",
 *         @OA\Contact(
 *             email="your-email@example.com"
 *         )
 *     ),
 *     @OA\Server(
 *         url="http://your-api-url.com",
 *         description="API Server"
 *     )
 * )
 */
// auth routes
Route::post("register", [AuthController::class, "register"]);
Route::post("login", [AuthController::class, "login"]);

Route::group([
    "middleware" => ["auth:api"]
], function () {
    Route::get("profile", [AuthController::class, "profile"]);
    Route::get("refresh", [AuthController::class, "refreshToken"]);
    Route::get("logout", [AuthController::class, "logout"]);
});
