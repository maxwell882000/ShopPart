<?php

namespace App\Http\Controllers\Api\Authorization;

use App\Http\Controllers\Api\Base\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends ApiController
{
    public function getUser(): \Illuminate\Http\JsonResponse
    {
        $user = auth()->user();
        $basket = $user->basket()->pluck('id');
        return $this->result([
            "name" => $user->avatar->name,
            "phone" => $user->phone,
            "avatar" => $user->avatar->avatar->fullPath(),
            "user_credit" => !!$user->userCreditData,
            'phone_verified' => $user->verifyUserOrSendCode(),
            'basket_counter' => $basket->count(),
            'basket_ids' => $basket,
            "favourite_counter" => $user->favourite()->count(),
        ]);
    }

    public function login(Request $request)
    {
        return $this->saveResponse(function () use ($request) {
            $this->validateRequest([
                "phone" => "required",
                "password" => "required"
            ]);
            if (Auth::attempt([
                'phone' => $request->phone,
                "password" => $request->password
            ])) {
                $user = Auth::user();
                return $this->result([
                    'token' => $user->login()
                ]);
            }
            return $this->errors(__("Не верные данные"), self::VALIDATION_ERROR);
        });

    }

    public function logout()
    {
        auth()->user()->logout();
    }

}
