<?php

namespace App\Domain\User\Traits;

use Illuminate\Support\Facades\Hash;

trait   PasswordHandle
{
    protected function updatePassword(array &$object_data)
    {

        if (isset($object_data["password"])) {
            $object_data["password"] = Hash::make($object_data["password"]);
        }
    }
}
