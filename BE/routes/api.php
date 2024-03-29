<?php

use App\Models\User;
use App\Mail\WelcomeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
 */

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post("/register", function (Request $request) {
    if (Auth::check()) {
        return response()->json(['status' => true, 'authenticated']);
    } else {
        $user = User::create($request->all());
        if ($user) {
            return response()->json(['status' => true, 'user' => $user]);
        } else {
            return response()->json(['status' => false]);
        }
    }

});
Route::post('/login', function (Request $request) {
    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        // The user is active.
        return Auth::check();
    } else {
        return Auth::check();
    }
});
Route::middleware('auth:api')->apiResource('posts', PostController::class);
Route::get('my-posts', [PostController::class, 'myPost'])->middleware('auth:api');
Route::middleware('auth:api')->post('like', [PostController::class, 'like']);
Route::get('testMail' , function(){
     Mail::to('mtr.fear@gmail.com')->send(new WelcomeMail());
});

