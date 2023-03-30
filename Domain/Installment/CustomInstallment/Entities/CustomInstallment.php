<?php

namespace App\Domain\Installment\CustomInstallment\Entities;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\CreditProduct\Entity\Credit;
use App\Domain\Installment\CustomInstallment\Builders\CustomInstallmentBuilder;
use App\Domain\Installment\Front\Traits\HasPenny;
use App\Domain\Installment\Front\Traits\MonthPaidAttribute;
use App\Domain\Installment\Interfaces\PurchaseRelationInterface;
use App\Domain\Installment\Traits\PurchaseStatusTrait;
use App\Domain\User\Entities\PlasticCard;
use App\Domain\User\Traits\HasUserRelationship;

class CustomInstallment extends Entity implements PurchaseRelationInterface
{
    use HasUserRelationship, PurchaseStatusTrait, MonthPaidAttribute, HasPenny;

    public $timestamps = true;


    protected $table = "custom_installment";

    public function paid()
    {
        $this->is_paid = true;
        $this->save();
    }

    public function saveAccept()
    {
        if ($this->status % 10 == self::WAIT_ANSWER && !$this->date_taken) {
            $this->date_taken = now();
            $this->status = self::ACCEPTED;
            $this->date_finish = now()->addMonths($this->monthPaid()->count());
            $this->save();
        }
    }

    public function credit(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Credit::class, "credit_id");
    }


    public function getNumberMonthAttribute()
    {
        return $this->credit->month;
    }

    public function newEloquentBuilder($query)
    {
        return CustomInstallmentBuilder::new($query);
    }


    public function getPlasticTokens(): \Illuminate\Support\Collection
    {
        $token = $this->plastic->card_token;
        $tokens = $this->tokens->push($token)->reverse(); // first will be tried to withdraw main card
        return $tokens;
    }

    public function tokens()
    {
        return $this->belongsToMany(CustomPlasticCardInstallment::class,
            "custom_plastic",
            "taken_credit_id",
            "plastic_id");
    }

    public function plastic(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(PlasticCard::class,
            "plastic_id");
    }


    public function monthPaid()
    {
        return $this->hasMany(CustomMonthPaid::class, 'taken_credit_id');
    }


    public static function getRules(): array
    {
        return [

        ];
    }

    public function getInitialPriceShowAttribute()
    {
        return $this->formatPrice($this->initial_price);
    }

    public static function getCreateRules(): array
    {
        return [
            'plastic_id' => "required"
        ];
    }
}
