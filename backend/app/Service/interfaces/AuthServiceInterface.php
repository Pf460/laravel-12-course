<?php

namespace App\Service\interfaces;

use App\Models\User;

interface AuthServiceInterface
{
    public function signUp(array $data): User;

    public function attemptLogin(string $email, string $password, bool $remember=false): bool;

    public function logout(): void;
}
