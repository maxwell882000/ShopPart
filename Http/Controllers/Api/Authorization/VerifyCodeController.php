<?php

namespace App\Http\Controllers\Api\Authorization;

use App\Http\Controllers\Api\Base\ApiController;
use Illuminate\Http\Request;

class VerifyCodeController extends ApiController
{
    public function sendCode()
    {
        auth()->user()->sendCode();
        return $this->result([
            'status' => true
        ]);
    }

    public function verifyCode(Request $request)
    {
        return $this->saveResponse(function () use ($request) {
            $this->validateRequest([
                "code" => "required"
            ]);
            return $this->result([
                'status' => auth()->user()->checkCode($request->code, true)
            ]);
        });

    }

    public function phoneCodeVerify(Request $request)
    {
        return $this->saveResponse(function () use ($request) {
            $this->validateRequest([
                "code" => "required"
            ]);
            return $this->result([
                'status' => auth()->user()->phoneVerify($request->code)
            ]);
        });
    }
}
