<?php

namespace App\Domain\CreditProduct\Entity;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Main\Interfaces\RuleInterface;
use App\Domain\CreditProduct\Builders\CreditBuilder;

class Credit extends Entity
{
    protected $table = "credits";
    protected $guarded = ['id'];

    public function newEloquentBuilder($query)
    {
        return CreditBuilder::new($query);
    }

    public function main(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(MainCredit::class, "main_credit_id");
    }

    static public function getRules(): array
    {
        return [
            'percent' => "required|numeric",
            'month' => "required|integer|max:12|min:1",
        ];
    }
}
