<?php

namespace App\Domain\Core\Front\Admin\Form\Interfaces;

interface ComplexFactoringConstants
{

    const INDEX = '$index';
    const SET_NAME = "%s{{" . self::INDEX . "}}->%s";
    const SET_NAME_WITHOUT = "%s{" . self::INDEX . "}->%s";
    const VALUE = '$value';
    const VALUE_WITHOUT = "value";
    const SET_VARIABLE = "{{ " . self::SET_VARIABLE_NOT_SCOPE . " }}";
    const SET_VARIABLE_NOT_SCOPE = self::VALUE . \CR::CR . "%s";
    const SET_VALUE_WIHOUT = self::VALUE_WITHOUT . \CR::CR . "%s";

    const ENTITY = '$entity';
    const ENTITY_WITHOUT = 'entity';
    const SET_ENTITY = "{{ " . self::SET_ENTITY_NOT_SCOPE . " }}";
    const SET_ENTITY_NOT_SCOPE = self::ENTITY . \CR::CR . "%s";
    const SET_ENTITY_WITHOUT = self::ENTITY_WITHOUT . \CR::CR . "%s";
}
