<?php

namespace App\Domain\Delivery\Api\Exceptions;

use App\Domain\Core\Main\Traits\ArrayHandle;
use App\Domain\Delivery\Api\Interfaces\DpdExceptionInterface;
use Throwable;

class DpdException extends \Exception implements DpdExceptionInterface
{
    use ArrayHandle;
    private string $error;

    public function __construct($message = "", string $error = "", $code = 0, Throwable $previous = null)
    {
        $this->error = $error;
        if (gettype($message) == "array") {
            $message = $this->arrayToKeyString($message);
        }
        parent::__construct($message, $code, $previous);
    }

    public function getError()
    {
        return $this->error;
    }
}
