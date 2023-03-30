<?php

namespace App\Domain\User\Middleware;

class AdminMiddleware
{
    public function handle($request, $next)
    {
        $user = auth()->user();
        if ($user && $this->permission(auth()->user())) {
            return $next($request);
        }
        return redirect()->route("login")->with("error", __($this->message()));
    }

    protected function permission($user): bool
    {
        return $user->isAdmin();
    }

    protected function message(): string
    {
        return "Вы не являетесь админом";
    }
}
