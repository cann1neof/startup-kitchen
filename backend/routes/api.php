<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\User;
use Illuminate\Support\Facades\Hash;

use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;


Route::post('/get_token', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        ]);
    $user = User::where('email', $request->email)->first();
    if (!$user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
        return response('emailError', 400);
    }
    error_log('works');
    
    $now = (new DateTime())->format('Y-m-d H:i:s');
    return $user->createToken($now)->plainTextToken;
});

Route::post('/register', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'name' => 'required',
        'username' => 'required'
    ]);
    $name = $request->name;
    $email = $request->email;
    $password = $request->password;
    $username = $request->username;

    if(User::where('email', $email)->exists()){
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
        return response('emailError', 400);
    }
    $user = User::create([
        "email" => $email,
        "username" => $username,
        "password"=> Hash::make($password),
        "name"=> $name
    ]);
        
    return response('success', 201);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/card/create', 'ProjectController@create');
Route::post('/card/{id}/img', 'UploadsController@uploadImage');
Route::get('/card/current/{id}', 'ProjectController@current');
Route::post('/card/search', 'ProjectController@search');
Route::get('/card/all', 'ProjectController@all');
