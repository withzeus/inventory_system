<?php

namespace App\Repositories\E;

use App\Ctx\CreateUserContext;
use App\Models\User;
use App\Repositories\AuthRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Override;

class AuthRepository implements AuthRepositoryInterface
{
    #[Override]
    public function createUser(CreateUserContext $ctx)
    {
        return User::create([
            'name' => $ctx->name,
            'email' => $ctx->email,
            'password' => Hash::make($ctx->password),
        ]);
    }

    #[Override]
    public function authenticate()
    {
        throw new \Exception('Not implemented');
    }

    #[Override]
    public function logout()
    {
        throw new \Exception('Not implemented');
    }
}
