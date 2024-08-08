<?php
namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{

    /**

     * @param  $request

     * @return mixed

     */

    public function toResponse($request)
    {

        $token = $request->user()->createToken($request->token_name);
        $user = $request->user();

        return $request->wantsJson() ? response()->json(compact($user,$token)) : redirect()->intended(config('fortify.home'));


    }

}
