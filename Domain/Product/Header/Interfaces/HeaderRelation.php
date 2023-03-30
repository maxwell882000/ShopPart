<?php

namespace App\Domain\Product\Header\Interfaces;

interface HeaderRelation
{
    const BODY_SERVICE = "body";
    const BODY_TO = self::BODY_SERVICE . \CR::CR;
}
