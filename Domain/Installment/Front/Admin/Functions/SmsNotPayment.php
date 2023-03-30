<?php

namespace App\Domain\Installment\Front\Admin\Functions;

use App\Domain\Core\Front\Admin\Livewire\Functions\Abstracts\AbstractFunction;
use App\Domain\Installment\Entities\TakenCredit;
use App\Domain\SchemaSms\Traits\HasRemainderSms;
use App\Http\Livewire\Admin\Base\Abstracts\BaseLivewire;

class SmsNotPayment extends AbstractFunction
{
    use HasRemainderSms;

    const FUNCTION_NAME = "sendNotPaid";
    protected ?BaseLivewire $component;
    protected  $taken_credit;
    protected $sms;

    public function __construct(?BaseLivewire $component = null)
    {
        $this->component = $component;
    }

    public function sendSms()
    {
        $this->getTakenCredit();
        $this->init();
    }

    private function getPhoneInput()
    {
        $phone = str_replace(" ", "", $this->component->phone);
        if ($phone != "") {
            return $phone;
        }
        return null;
    }

    static public function sendNotPaid(BaseLivewire $component)
    {
        $class = new static($component);
        $class->sendSms();
//        $taken = TakenCredit::find($component->filterBy['taken_credit_id']);
//        $sms = SchemaSmsInstallment::remainder()->first();
//        $name = str_replace($sms->getConcreteTypeValue(SchemaSmsType::TYPE_NAME), $taken->userData->name, $sms->schema);
//        $order = str_replace($sms->getConcreteTypeValue(SchemaSmsType::TYPE_NUMBER_ORDER), $taken->purchase_id, $name);
//        try {
//            $phoneService = new PhoneService();
//            $phoneService->send_code($taken->user->phone, $order);
//            session()->flash("success", __("Сообщение успешно отправлено"));
//        } catch (PhoneError $exception) {
//            $component->addError("phone",
//                __("Произошла ошибки при отправке сообщения")
//                . " " . $exception->getMessage());
//        }
    }


    protected function getPhone()
    {
        return $this->taken_credit->user->phone;
    }

    protected function getTakenCredit()
    {
        $this->taken_credit = TakenCredit::find($this->component->filterBy['taken_credit_id']);
    }

    function phone()
    {
        return $this->getPhoneInput() ?? $this->getPhone();
    }
}
