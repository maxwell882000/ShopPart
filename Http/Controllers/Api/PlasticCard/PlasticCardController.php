<?php

namespace App\Http\Controllers\Api\PlasticCard;

use App\Domain\Core\Api\CardService\BindCard\Error\BindCardError;
use App\Domain\Core\Api\CardService\BindCard\Model\BindCardService;
use App\Domain\Core\Api\CardService\Error\CardServiceError;
use App\Domain\Core\Main\Traits\ArrayHandle;
use App\Domain\User\Api\PlasticCardApi;
use App\Domain\User\Entities\PlasticCard;
use App\Domain\User\Services\PlasticCardService;
use App\Http\Controllers\Api\Base\ApiController;

class PlasticCardController extends ApiController
{
    use ArrayHandle;

    public function getCards(): \Illuminate\Http\JsonResponse
    {
        return $this->result([
            "cards" => PlasticCardApi::joinUserWhere(auth()->user()->id)->get(),
        ]);
    }

    public function getTransactionForPlastic(): \Illuminate\Http\JsonResponse
    {
//        return $this->result([
//            'transaction_id' => 123323
//        ]);

        return $this->saveResponse(function () {
            try {
                $this->validateRequest([
                    'card_number' => "required|min:16|max:19",
                    'expiry' => "required|min:5|max:5"
                ]);
                $service = new BindCardService();
                $transaction_id = $service->create($this->request->card_number, $this->request->expiry, app()->getLocale());
                return $this->result([
                    'transaction_id' => $transaction_id,
                ]);
            } catch (BindCardError $exception) {
                if ($exception->getCode() === BindCardError::ALREADY_EXISTS) {
                    return $this->errors(__("Эта карту уже используеться, пожалуйста введите другую !"));
                }
            } catch (CardServiceError $exception) {
            }
            return $this->errors(__("Произошла ошибка! Попробуйте ввести даные позже или другую карту!"));
        });
    }

    public function dialCode()
    {

        return $this->saveResponse(function () {
            $this->validateRequest([
                'transaction_id' => "required"
            ]);
            $service = new BindCardService();
            return $service->dial($this->request->transaction_id);
        });
    }

    public function insertCard()
    {
        $object_data = $this->request->all();
        $object_data['user_id'] = auth()->user()->id;
        return $this->create(PlasticCardService::new(), $object_data);
    }

    public function revokeCard(PlasticCard $card)
    {
        return $this->saveResponse(function () use ($card) {
            $this->destroy(PlasticCardService::new(), $card);
        });
    }
}
