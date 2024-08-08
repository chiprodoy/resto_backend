<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $user = Auth::user();
        $token = $request->user()->createToken('store');

        if($request->wantsJson()){
            return response()->json(['user'=>$user,'access_token'=>$token->plainTextToken]);
        }else{
            $request->session()->regenerate();
            return response()->noContent();
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        if($request->wantsJson()){
            $request->user()->currentAccessToken()->delete();
            return response('');
        }else{
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return response()->noContent();
        }

    }
}
