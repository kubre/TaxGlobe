<?php

namespace App\Actions\Account;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Http\Requests\LoginRequest as Request;

class AuthenticateLoginAttempt
{
    public function handle(Request $request)
    {
        $user = User::where('username', $request->username)->first();

        if (
            $user &&
            Hash::check($request->password, $user->password)
        ) {
            return $user;
        }
    }
}
