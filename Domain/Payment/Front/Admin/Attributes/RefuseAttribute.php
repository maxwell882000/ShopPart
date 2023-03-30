<?php

namespace App\Domain\Payment\Front\Admin\Attributes;

use App\Domain\Payment\Front\Admin\Functions\DenyPayment;

class RefuseAttribute extends \App\Domain\Installment\Front\Admin\Attributes\RefuseAttribute
{
  const DENY_FUNCTION =  DenyPayment::FUNCTION_NAME;
}
