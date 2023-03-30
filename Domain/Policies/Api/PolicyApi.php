<?php

namespace App\Domain\Policies\Api;

use App\Domain\Policies\Entity\Policy;

class PolicyApi extends Policy
{
    public function toArray()
    {
        return [
            "policy" => $this->policy
        ];
    }
}
