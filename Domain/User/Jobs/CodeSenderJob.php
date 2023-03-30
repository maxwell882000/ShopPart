<?php

namespace App\Domain\User\Jobs;

use App\Domain\Core\Api\PhoneService\Model\PhoneService;
use App\Domain\Core\BackgroundTask\Base\AbstractJob;
use App\Domain\User\Entities\User;
use Illuminate\Support\Facades\Log;

class CodeSenderJob extends AbstractJob
{
    private User $user;
    const CODE = "Код подтверждения для ByShop : ";

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    private function getTanslatedCode()
    {
        return __(self::CODE) . "%s";
    }

    private function getMessage()
    {
        return sprintf($this->getTanslatedCode(), $this->getCode());
    }

    protected function getCode()
    {
        return $this->user->code->code;
    }

    protected function getPhone()
    {
        return $this->user->phone;
    }

    public function handle()
    {
        $sms = new PhoneService();
        $result = $sms->send_code($this->getPhone(), $this->getMessage());
        Log::info($result);
    }
}
