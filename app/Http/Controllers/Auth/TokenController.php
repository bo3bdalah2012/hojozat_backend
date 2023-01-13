<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class TokenController extends Controller
{
    /**
     * @throws AuthenticationException
     * @throws ValidationException
     */
    public function store(Request $request): array
    {
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if(!auth()->attempt($request->only('email','password'))){
            throw new AuthenticationException();
        }

        $token = $request->user()->createToken('web');
        return [
            'token' => $token->plainTextToken
        ];
    }
}
