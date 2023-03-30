<?php

namespace App\Domain\Core\Api\CardService\BindCard\Error;

use App\Domain\Core\Api\CardService\Error\CardServiceError;

class BindCardError extends CardServiceError
{
    const ALREADY_EXISTS = 111111111; // the message will contain string json of the response so data could be extracted
}
