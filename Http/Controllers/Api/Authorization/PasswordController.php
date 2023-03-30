<?php

namespace App\Http\Controllers\Api\Authorization;

use App\Domain\User\Entities\User;
use App\Domain\User\Services\RegisterService;
use App\Http\Controllers\Api\Base\ApiController;
use Illuminate\Http\Request;

class PasswordController extends ApiController
{
    public function changePassword(Request $request)
    {
        return $this->saveResponse(function () use ($request) {
            $this->validateRequest([
                "password" => "required|current_password:sanctum",
                "password_new" => "required",
                "password_rep" => "required|same:password_new"
            ]);
            return $this->updateCustom(RegisterService::new(), auth()->user(), function ($object) {
                return $this->result([
                    'status' => true
                ]);
            }, [
                'password' => $request->password_new
            ]);
        });

    }

    public function issuePasswordToken(Request $request): \Illuminate\Http\JsonResponse
    {
        return $this->saveResponse(function () use ($request) {
            $this->validateRequest([
                "phone" => 'required'
            ]);
            $user = User::where("phone", $request->phone);
            if ($user->exists()) {
                $user = $user->first();
                $user->sendCode();
                return $this->result([
                    "token" => $user->tokenForResetPassword()
                ]);
            }
            return $this->errors(__("Введенный номер неверен"));
        });
    }

    public function forgetPassword(Request $request)
    {
        $this->validateRequest([
            "password" => "required",
            "password_repeat" => "required|same:password",
        ]);
        return $this->saveResponse(function () use ($request) {
            auth()->user()->checkCode("", true);
            return $this->updateCustom(RegisterService::new(), auth()->user(), function (User $object) {
                $object->tokens()->delete();
                return $this->result([
                    'status' => true,
                ]);
            });
        });
    }
}
