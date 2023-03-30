<?php

namespace App\Domain\User\Traits;

use App\Domain\User\Entities\PhoneCode;
use App\Domain\User\Jobs\CodeSenderJob;
use App\Domain\User\Services\PhoneCodeService;

trait SmsTrait
{
    public function isVerified()
    {
        return $this->phone_verified_at != null;
    }

    public function markSms()
    {
        $this->phone_verified_at = now();
        $code = $this->code;
        $code->status = false;
        $code->save();
        $this->save();
    }

    public function code()
    {
        return $this->hasOne(PhoneCode::class, "user_id");
    }

    public function verifyUserOrSendCode()
    {
        $isVerified = !!$this->phone_verified_at;
        if (!$isVerified) {
            $this->sendCode();
        }
        return $isVerified;
    }

    public function sendCode()
    {
        PhoneCodeService::new()->createOrUpdate($this, 'code', ['user_id' => $this->id]);
        CodeSenderJob::dispatch($this);
    }

    public function dropPhone() // when phone is changed
    {
        $this->phone_verified_at = null;
        $this->save();
        $this->sendCode();
    }

    public function checkCode($code, $throw = false)
    {
        if ($this->code->status) {
            $this->code->status = false;
            $this->code->save();
            return true;
        }
        if ($this->code->code != -1 && $this->code->code == intval($code)) {
            $this->code->code = -1;
            $this->code->status = true;
            $this->code->save();
            return true;
        }
        if ($throw) {
            throw new \Exception(__("Код не совпал"), 403);
        }
        return false;
    }

    public function phoneVerify($code): bool
    {
        if ($this->checkCode($code, true)) {
            $this->markSms();
            return true;
        }
        return false;
    }
}
