<?php

namespace App\Domain\Installment\Entities;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\CreditProduct\Entity\Credit;
use App\Domain\Installment\Builders\TakenCreditBuilder;
use App\Domain\Installment\Front\Traits\HasPenny;
use App\Domain\Installment\Front\Traits\MonthPaidAttribute;
use App\Domain\Installment\Interfaces\PurchaseRelationInterface;
use App\Domain\Installment\Traits\PurchaseStatusTrait;
use App\Domain\Order\Entities\UserPurchase;
use App\Domain\Payment\Interfaces\PaymentAction;
use App\Domain\User\Entities\PlasticCard;
use App\Domain\User\Entities\UserCreditData;
use App\Domain\User\Front\Open\SuretyOpenEdit;
use App\Domain\User\Traits\HasUserRelationship;

/**
 * made tomorrow the installment
 */
class TakenCredit extends Entity implements PurchaseRelationInterface, PaymentAction
{
    use HasUserRelationship, PurchaseStatusTrait, MonthPaidAttribute, HasPenny;

    public $timestamps = true;


    protected $table = "taken_credits";


    public function paid()
    {
        $this->is_paid = true;
        $this->save();
    }

    public function saveSurety($surety_id)
    {
        $this->surety_id = $surety_id;
        $this->status = self::REQUIRED_SURETY_ADDED + $this->status % 10;
        $this->save();
    }

    public function saveAccept()
    {
        if ($this->status % 10 == self::WAIT_ANSWER && !$this->date_taken) {
            $this->date_taken = now();
            $this->status = self::ACCEPTED;
            $this->purchase->saveAccept();
            $this->date_finish = now()->addMonths($this->monthPaid()->count());
            $this->save();
        }
    }

    public function reason()
    {
        return $this->hasOne(TakenCreditError::class, 'id');
    }

    public function newEloquentBuilder($query)
    {
        return TakenCreditBuilder::new($query);
    }


    public function getPlasticTokens(): \Illuminate\Support\Collection
    {
        $token = $this->plastic->card_token;
        $surety_tokens = $this->surety ? $this->surety->getPlasticTokens() : collect([]);
        $tokens = $this->tokens->push($token)->reverse(); // first will be tried to withdraw main card
        return $tokens->concat($surety_tokens); // then tokens from takenCredit ,only after from surety
    }

    public function tokens()
    {
        return $this->belongsToMany(PlasticCardTakenCredit::class,
            "plastic_card_taken_credit",
            "taken_credit_id",
            "plastic_id");
    }

    public function surety(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(SuretyOpenEdit::class, 'surety_id');
    }

    public function userData(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(UserCreditData::class,
            "user_credit_data_id");
    }

    public function plastic(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(PlasticCard::class,
            "plastic_id");
    }

    public function getNumberMonthAttribute()
    {
        return $this->credit->month;
    }

    public function getPriceAttribute()
    {
        return $this->allToPay() + $this->initial_price;
    }

    public function getInitialPriceShowAttribute()
    {
        return $this->formatPrice($this->initial_price);
    }

    public function credit(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Credit::class, "credit_id");
    }

    public function purchase(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(UserPurchase::class, "purchase_id");
    }

    public function monthPaid()
    {
        return $this->hasMany(MonthPaid::class, 'taken_credit_id');
    }

    public static function getRules(): array
    {
        return [
            "initial_price" => "sometimes|required"
        ];
    }

}
