<?php

namespace App\Domain\User\Traits;

use Laravel\Sanctum\HasApiTokens;

trait TokenRegister
{
    use HasApiTokens;

    // check if there is no other token with the same name
    public function registered($name = ""): string
    {
        return $this->issueToken($name ?? now());
    }

    public function checkName($name): bool
    {
        return $this->tokens()->where("name", "=", $name)->exists();
    }

    private function issueToken($name): string
    {
        return $this->createToken($name, ["server-full"])->plainTextToken;

    }

    public function tokenForResetPassword(): string
    {
        return $this->createToken("reset-password", ["server-password"])->plainTextToken;
    }

    public function login($name = "")
    {
        return $this->issueToken($name ?? now());
    }

    public function logout()
    {
        $this->currentAccessToken()->delete();
    }
}
