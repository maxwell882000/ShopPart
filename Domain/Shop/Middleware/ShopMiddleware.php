<?php

namespace App\Domain\Shop\Middleware;

use App\Domain\User\Middleware\AdminMiddleware;

class ShopMiddleware extends AdminMiddleware
{
    protected function permission($user): bool
    {
        return $user->isShop();
    }
}
