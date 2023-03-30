<?php

namespace App\Http\Controllers\Api\Interfaces;

interface ApiControllerInterface
{
    const PREFIX_RESULT = "result";
    const PREFIX_ERRORS = "errors";
    const FILTER = "filter";
    const BIG_PAGINATE = 30;
    const NORMAL_PAGINATE = 15;
    const SMALL_PAGINATE = 10;

    const VALIDATION_ERROR = 400;

}
