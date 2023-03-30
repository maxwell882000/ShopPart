<?php

namespace App\Domain\User\Middleware;

class ModeratorMiddleware extends AdminMiddleware
{
    protected function message(): string
    {
        return "Вы не являетесь модератором";
    }

    protected function permission($user): bool
    {
        return $user->isModerator();
    }
}
