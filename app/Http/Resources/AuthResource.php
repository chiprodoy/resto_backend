<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user=User::find($request->user()->id);
        $token = $request->user()->createToken('auth_token');
        $refresh_token=$request->user()->createToken('refresh_token');

        return [
            'access_token'=>$token->plainTextToken,
            'refresh_token'=>$refresh_token->plainTextToken,
            'user'=>[
                'id'=>$this->id,
                'name'=>$this->name,
                'email'=>$this->email,
                'roles'=>$this->roles,
                'merchants'=>$this->merchants
            ]
        ];
    }
}
