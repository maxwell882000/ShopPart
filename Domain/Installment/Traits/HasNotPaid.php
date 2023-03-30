<?php

namespace App\Domain\Installment\Traits;

use App\Domain\Installment\Interfaces\PurchaseStatus;

trait HasNotPaid
{
    public static function bootHasNotPaid()
    {
        static::retrieved(function ($entity) {
            $entity->checkIsNotPaid();
        });
    }

    public function isNotPaid()
    {
        return $this->status == PurchaseStatus::NOT_PAID;
    }

    public function checkIsNotPaid()
    {
        $unpaid = $this->unpaidCredits()->where("taken_credits.id", $this->id)->exists();
        if ($this->status == PurchaseStatus::ACCEPTED && $unpaid) {
            $this->status = PurchaseStatus::NOT_PAID;
        } else if ($this->status == PurchaseStatus::NOT_PAID && !$unpaid) {
            $this->status = PurchaseStatus::ACCEPTED;
        }
        $this->save();
    }

}
