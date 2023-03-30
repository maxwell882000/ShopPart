<?php

namespace App\Domain\Core\Front\Js\Interfaces;

interface FilterJsInterface
{
    const ONLY_NUMBER = "onlyNumbers(event)";
    const FORMAT_DATE_FOR_CARD = "formatDateForCard(event)";
    const FORMAT_CARD_NUMBER = "formatCardNumber(event)";
}
