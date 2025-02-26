<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (auth()->attempt($credentials)) {
            $user = Auth::user();
            $user1 = new User();

            $user1->mapper($user);

            $user1->tokens()->delete();

            $success['token'] = $user1->createToken(request()->userAgent())->plainTextToken;
            $success['name'] = $user->first_name;
            $success['success'] = true;

            return response()->json($success, 200);
        } else {
            return response()->json(['error' => 'Unauthorized', 401]);
        }
    }
}
