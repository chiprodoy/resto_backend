<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\AuthResource;
use App\Models\User;
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

        if($request->wantsJson()){
            return new AuthResource(User::find($request->user()->id));
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
