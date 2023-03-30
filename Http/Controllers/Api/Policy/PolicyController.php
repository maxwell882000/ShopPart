<?php

namespace App\Http\Controllers\Api\Policy;

use App\Domain\Policies\Api\PolicyApi;
use App\Http\Controllers\Api\Base\ApiController;

class PolicyController extends ApiController
{
    public function index()
    {
        return $this->result(PolicyApi::first());
    }
}
