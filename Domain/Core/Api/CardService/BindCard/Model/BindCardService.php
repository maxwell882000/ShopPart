<?php

namespace App\Domain\Core\Api\CardService\BindCard\Model;

use App\Domain\Core\Api\CardService\BindCard\Error\BindCardError;
use App\Domain\Core\Api\CardService\Model\AuthPaymoService;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BindCardService extends AuthPaymoService
{
    const SERVER = parent::SERVER . "partner/bind-card/";
    public string $token;

    public function __construct()
    {
        parent::__construct();
        $this->token = $this->getToken();
    }

    private function transformDate($date): string
    {
        $divide = explode("/", $date);
        if (count($divide) == 2) {
            return $divide[1] . $divide[0];
        }
        throw new BindCardError(__("Не правильный формат даты"), BindCardError::ERROR_OCCURRED);
    }

    protected function checkOnError($object, Response $response = null)
    {
        if ($this->checkErrorCondition($object)) {
            if ($object['result']['code'] == "STPIMS-ERR-133") {
                throw new BindCardError($response->body(), BindCardError::ALREADY_EXISTS);
            }
            parent::checkOnError($object, $response);
        }
    }
    public function create($card_number, $expiry, $language = 'ru')
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->post(self::SERVER . 'create', [
            'card_number' => str_replace(" ", '', $card_number),
            'expiry' => $this->transformDate($expiry),
            'lang' => $language
        ]);
        // dd($response->body());
        $object = $response->json();
        // dd($object);
        $this->checkOnError($object, $response);
        // dd($object);
        return $object['transaction_id'];
    }


    public function apply($transaction_id, $otp, $language = "ru")
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->post(self::SERVER . 'apply', [
            'transaction_id' => $transaction_id,
            'otp' => $otp,
            'lang' => $language
        ]);
        $object = $response->json();
        $this->checkOnError($object, $response);
        return $object;
    }

    public function dial($transaction_id, $language = "ru")
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->put(self::SERVER . 'dial', [
            'transaction_id' => $transaction_id,
            "lang" => $language
        ]);
        $response_decoded = $response->json();
        return $response_decoded;
    }

    public function list_cards($page, $page_size, $language = "ru")
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->post(parent::SERVER . 'partner/list-cards', [
            'page' => $page,
            'page_size' => $page_size,
            "lang" => $language
        ]);
        $response_decoded = $response->json();
        return $response_decoded;
    }

    public function remove_card($card_token,$card_id , $language = "ru")
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->post(parent::SERVER . 'partner/remove-card', [
            'token' => $card_token,
            "id" => null, // ask what id is required to make request
            "lang" => $language
        ]);
        $response_decoded = $response->json();
        return $response_decoded;
    }
}
