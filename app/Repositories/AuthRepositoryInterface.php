<?php

namespace App\Repositories;

use App\Ctx\CreateUserContext;

interface AuthRepositoryInterface
{
    public function createUser(CreateUserContext $ctx);

    public function authenticate();

    public function logout();
}
