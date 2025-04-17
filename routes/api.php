<?php

use App\Http\Controllers\API\ClassesContoller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

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
Route::get('/Class-Summary', [ClassesContoller::class,'index']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

 Route::post('/register', function (Request $request) {
    $request->validate([
        'user_name' => 'required',
        'email' => 'required|email',
        'password' => 'required',
        'user_type' => 'required',
    ]);
    $user = User::create([
        'email' => $request->email,
            'name' => $request->user_name,
            'password' => Hash::make($request->password),
            'utype' => $request->user_type
        ]);
    return $user->id;
});
Route::post('/sanctum/token', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required',
    ]);
    $user = User::where('email', $request->email)->whereNotNull('email_verified_at')->first();
    if (! $user || ! Hash::check($request->password, $user->password)) {
       return response()->json([
        'statusCode' =>202,
        'message' => 'No record Matches the Supplied Details'
    ], 202);
    }
    return $user->createToken($request->device_name)->plainTextToken;
});
Route::middleware('auth:sanctum')->get('/user/revoke', function (Request $request) {
    $user = $request->user();
    $user->tokens()->delete();
    return response()->json([
        'statusCode' =>202,
        'message' => 'Logged Out Successfully'
    ], 202);
});