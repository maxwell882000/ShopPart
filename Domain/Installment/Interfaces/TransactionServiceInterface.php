<?php

namespace App\Domain\Installment\Interfaces;

interface TransactionServiceInterface
{
    const MONTH_PAY = "Ежемесячная оплата";
    const MONTH_PENNY = "Пенни за не оплату";
    const MONTH_PAY_CLIENT = "Опалата клиентом";
}
