<?php

namespace App\Domain\Core\Api\CardService\Error;

class CardServiceError extends \Exception
{
    const ERROR_OCCURRED = 99999999; // throw description string of error message
    const NOT_INITIAL_PAY = -33333333; // initial_pay will become hold money
}
