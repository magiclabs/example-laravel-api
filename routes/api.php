<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use Magic;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// This endpoint does not need authentication.
Route::get('/public', function (Request $request) {
    return response()->json(["message" => "Hello from a public endpoint! You don't need to be authenticated to see this."]);
});

// These endpoints require a valid did token and fetches user's data using did token
Route::get('/private', function (Request $request) {
    return response()->json([
        "message" => "Hello from a private endpoint! You need to have a valid DID Token to see this.",
        "user" => Magic::user()->get_metadata_by_token($request->bearerToken())->data
        ]);
})->middleware('didt');