<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\User;
use Illuminate\Support\Facades\Hash;

use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;



Route::get('/', function () {
    return view('welcome');
});

Route::get('upload_file', function () {
    return view('upload');
});

Route::post('store_file', 'FileUploadController@fileStore');

Route::post('/get_token', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required'
    ]);
 
    $user = User::where('email', $request->email)->first();
 
    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }
 
    return $user->createToken($request->device_name)->plainTextToken;
});
Route::post('/register', function (Request $request) {
    User::create([
        'name' => $request->$name,
        'email' => $request->$email,
        'password' => Hash::make($request->$password),
        'username' => $request->$username
    ]);

    return response($response, 200);
});

Route::post('/login', function (Request $request) {
    $data = $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response([
            'message' => ['These credentials do not match our records.']
        ], 404);
    }

    $token = $user->createToken('my-app-token')->plainTextToken;

    $response = [
        'user' => $user,
        'token' => $token
    ];

    return response($response, 201);
});

Route::middleware('auth:sanctum')->get('/get_all', 'ProjectController@getAll');
Route::middleware('auth:sanctum')->post('/create', 'ProjectController@create');
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
