<?php

namespace App\Domain\Product\Product\Interfaces;

use App\Domain\Product\Header\Interfaces\HeaderRelation;

interface ProductInterface
{
    const CURRENCY_USD_DB = 1;
    const CURRENCY_UZS_DB = 2;
    const CURRENCY_USD_TEXT = "USD";
    const CURRENCY_UZS_TEXT = "UZS";
    const   DB_TO_TEXT = [
        self::CURRENCY_USD_DB => self::CURRENCY_USD_TEXT,
        self::CURRENCY_UZS_DB => self::CURRENCY_UZS_TEXT
    ];
    const TEXT_TO_DB = [
        self::CURRENCY_UZS_TEXT => self::CURRENCY_UZS_DB,
        self::CURRENCY_USD_TEXT => self::CURRENCY_USD_DB
    ];

    const IMAGE_SERVICE = "productImage";
    const CARD_IMAGE_SERVICE = "productImageHeader";
    const PRODUCT_KEY_SERVICE = "productKey";
    const PRODUCT_DAY_SERVICE = "productDay";
    const PRODUCT_HIT_SERVICE = "productHit";
    const MAIN_CREDIT_SERVICE = "mainCredit";
    const HEADER_TEXT_SERVICE = "headerText";
    const BODIES_SERVICE = "bodies";
    const COLORS_SERVICE = "colors";
    const DESCRIPTION_SERVICE = "description";
    const COLORS_TEMP = self::COLORS_SERVICE . "_new_created";
    const PRODUCT_KEY_TO = self::PRODUCT_KEY_SERVICE . \CR::CR;
    const DESCRIPTION_TO = self::DESCRIPTION_SERVICE . \CR::CR;
    const COLORS_TO = self::COLORS_SERVICE . \CR::CR;
    const BODIES_TO = self::BODIES_SERVICE . \CR::CR;
    const HEADER_TEXT_TO = self::HEADER_TEXT_SERVICE . \CR::CR;
    const BODIES_INSIDE_TO = self::BODIES_TO . HeaderRelation::BODY_TO; // for front mention
    const CARD_IMAGE_TO = self::CARD_IMAGE_SERVICE . \CR::CR;
    const PRODUCT_DAY_TO = self::PRODUCT_DAY_SERVICE . \CR::CR;
    const PRODUCT_HIT_TO = self::PRODUCT_HIT_SERVICE . \CR::CR;
    const IMAGE_TO = self::IMAGE_SERVICE . \CR::CR;
}

