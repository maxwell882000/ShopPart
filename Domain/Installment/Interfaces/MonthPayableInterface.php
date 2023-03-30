<?php

namespace App\Domain\Installment\Interfaces;

use App\Domain\Core\Api\CardService\Interfaces\Payable;

interface MonthPayableInterface extends Payable
{
    public function getTakenCreditId();
    public function getTransactionService();
    
}
