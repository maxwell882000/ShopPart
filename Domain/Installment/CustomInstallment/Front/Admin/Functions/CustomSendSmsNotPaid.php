<?php

namespace App\Domain\Installment\CustomInstallment\Front\Admin\Functions;

use App\Domain\Installment\CustomInstallment\Entities\CustomInstallment;
use App\Domain\Installment\Front\Admin\Functions\SmsNotPayment;

class CustomSendSmsNotPaid extends SmsNotPayment
{
    protected function messageId()
    {
        return $this->taken_credit->contract_num;
    }

    protected function messageName()
    {
        return $this->taken_credit->name;
    }

    protected function getPhone()
    {
        return $this->taken_credit->plastic->phone;
    }

    protected function getTakenCredit()
    {
        $this->taken_credit = CustomInstallment::find($this->component->filterBy['taken_credit_id']);
    }
}
