<?php

namespace App\Domain\User\Interfaces;

interface SuretyRelationInterface
{
    const CRUCIAL_DATA = self::CRUCIAL_DATA_SERVICE . \CR::CR;
    const PLASTIC = self::PLASTIC_SERVICE . \CR::CR;
    const CRUCIAL_DATA_SERVICE = "crucialData";
    const PLASTIC_SERVICE = "plastic";
}
