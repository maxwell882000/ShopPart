<?php

namespace App\Domain\SchemaSms\Traits;

use App\Domain\Core\Api\PhoneService\Error\PhoneError;
use App\Domain\Core\Api\PhoneService\Model\PhoneService;
use App\Domain\SchemaSms\Interfaces\SchemaSmsType;

trait HasSendSms
{
    protected $sms;
    protected $taken_credit;

    abstract function getSms();

    final protected function prepareMessage(): string
    {
        $value = $this->createMessage(SchemaSmsType::TYPE_NAME, $this->messageName(), $this->sms->schema);
        return $this->createMessage(SchemaSmsType::TYPE_NUMBER_ORDER, $this->messageId(), $value);
    }

    protected function createMessage($type, $value, $text): string
    {
        return str_replace($this->sms->getConcreteTypeValue($type), $value, $text);
    }

    function init()
    {
        $this->getSms();
        $message = $this->prepareMessage();
        $this->send($message);
    }

    private function send($message)
    {
        try {
            $phoneService = new PhoneService();
            $phoneService->send_code($this->phone(), $message);
            session()->flash("success", __("Сообщение успешно отправлено"));
        } catch (PhoneError $exception) {
            $this->component->addError("phone",
                __("Произошла ошибки при отправке сообщения")
                . " " . $exception->getMessage());
        }
    }

    abstract function phone();

    protected function messageName()
    {
        return $this->taken_credit->userData->name;
    }

    protected function messageId()
    {
        return $this->taken_credit->purchase_id;
    }

}
