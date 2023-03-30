<?php

namespace App\Domain\SchemaSms\Entities;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\SchemaSms\Builders\SchemaSmsInstallmentBuilder;
use App\Domain\SchemaSms\Interfaces\SchemaSmsType;
use App\Domain\SchemaSms\Traits\TypeSchemaSmsFactory;

class SchemaSmsInstallment extends Entity implements SchemaSmsType
{
    use TypeSchemaSmsFactory;

    protected $table = "schema_sms_installment";

    public function newEloquentBuilder($query)
    {
        return new SchemaSmsInstallmentBuilder($query);
    }
}
