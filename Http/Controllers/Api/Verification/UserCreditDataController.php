<?php

namespace App\Http\Controllers\Api\Verification;

use App\Domain\Installment\Entities\TakenCredit;
use App\Domain\User\Services\SuretyService;
use App\Domain\User\Services\UserCreditDataService;
use App\Http\Controllers\Api\Base\ApiController;

class UserCreditDataController extends ApiController
{
    public function createUserData()
    {
        $request_data = $this->request->all();
        $request_data['user_id'] = auth()->user()->id;
        return $this->create(UserCreditDataService::new(), $request_data);
    }

    public function createSurety(TakenCredit $takenCredit)
    {
        return $this->saveResponse(function () use ($takenCredit) {
            $request_data = $this->request->all();
            $request_data['user_id'] = auth()->user()->id;
            $object = SuretyService::new()->create($request_data);
            $takenCredit->saveSurety($object['id']);
            return $this->result([
                'status' => $takenCredit->status
            ]);
        });

    }
}
