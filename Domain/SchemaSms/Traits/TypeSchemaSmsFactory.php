<?php

namespace App\Domain\SchemaSms\Traits;

use App\Domain\SchemaSms\Entities\SchemaSmsInstallment;
use App\Domain\SchemaSms\Entities\SchemaSmsRegistration;
use App\Domain\SchemaSms\Front\Headers\HeaderSchemaSms;
use App\Domain\SchemaSms\Front\Values\ValueHeader;
use App\Domain\SchemaSms\Interfaces\SchemaSmsType;

trait TypeSchemaSmsFactory
{

    public function getNameSchemaAttribute()
    {

        return $this->getSmsSchema(self::class, $this->type)->name;
    }

    public function getTypeSchemaAttribute(): array
    {

        return $this->getSmsSchema(self::class, $this->type)->values;
    }

    public function getConcreteType($type)
    {
        return $this->getSmsSchema(self::class, $this->type)->values[$type];
    }

    public function getConcreteTypeValue($type)
    {
        return $this->getConcreteType($type)->value;
    }

    public function getSmsSchema(string $selected, $type)
    {
        try {
            $choices = $this->allSchema($selected);
            return $choices[$type];
        } catch (\Exception $exception) {
            throw new \Exception(self::class . "\n wrong getSmsSchema type which" . $type);
        }
    }

    public function getTypeSchemaValuesAttribute(): array
    {
        return collect($this->getSmsSchema(self::class, $this->type)->values)->map(function ($e) {
            return $e->value;
        })->toArray();
    }

    public function allSchema($selected): array
    {
        return [
            SchemaSmsRegistration::class => [

            ],
            SchemaSmsInstallment::class => [
                SchemaSmsType::REMAINDER_PAYMENT => new HeaderSchemaSms(__("Напоминание об оплате"),
                    SchemaSmsType::REMAINDER_PAYMENT, [
                        SchemaSmsType::TYPE_NAME => new ValueHeader("Ф.И.О", '${name}'),
                        SchemaSmsType::TYPE_NUMBER_ORDER => new ValueHeader("Номер заказа", '${order}'),
                    ]),
                SchemaSmsType::DAY_OF_PAYMENT => new HeaderSchemaSms(__("Наступил день оплаты"),
                    SchemaSmsType::DAY_OF_PAYMENT, [
                        SchemaSmsType::TYPE_NAME => new ValueHeader("Ф.И.О", '${name}'),
                        SchemaSmsType::TYPE_NUMBER_ORDER => new ValueHeader("Номер заказа", '${order}'),

                    ]),
                SchemaSmsType::EXPIRED_PAYMENT => new  HeaderSchemaSms(__("Просроченный платеж"),
                    SchemaSmsType::EXPIRED_PAYMENT, [
                        SchemaSmsType::TYPE_NAME => new ValueHeader("Ф.И.О", '${name}'),
                        SchemaSmsType::TYPE_NUMBER_ORDER => new ValueHeader("Номер заказа", '${order}'),
                    ]),
                SchemaSmsType::AFTER_PAYMENT => new HeaderSchemaSms(__("Оплаченный платеж"),
                    SchemaSmsType::AFTER_PAYMENT, [
                        SchemaSmsType::TYPE_NAME => new ValueHeader("Ф.И.О", '${name}'),
                        SchemaSmsType::TYPE_NUMBER_ORDER => new ValueHeader("Номер заказа", '${order}'),

                    ])
            ]
        ][$selected];
    }
}
