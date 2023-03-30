<?php

namespace App\Http\Controllers\Api\Authorization;

use App\Domain\User\Services\RegisterService;
use App\Http\Controllers\Api\Base\ApiController;

class RegisterController extends ApiController
{
    public function register()
    {
        return $this->createCustom(RegisterService::new(), function ($object) {
            return $this->result([
                "token" => $object->registered()
            ]);
        });
    }
}
