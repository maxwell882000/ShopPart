<?php

namespace App\Domain\Core\Api\CardService\Merchant\Model;

use App\Domain\Core\Api\CardService\Model\AuthPaymoService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Merchant extends AuthPaymoService
{
    const SERVER = parent::SERVER . "merchant/pay/";
    const STORE_ID = self::EXECUTE . "STORE_ID";
    private string $token;
    private string $store_id;

    public function __construct()
    {
        parent::__construct();
        $this->token = $this->getToken();
        $this->store_id = env(self::STORE_ID);
    }

    public function create($amount, $account, $terminal_id = null, $details = null): int
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->post(self::SERVER . 'create', [
            'amount' => $amount * 100,
            'account' => $account,
            'store_id' => $this->store_id,
            'terminal_id' => $terminal_id,
            'details' => $details
        ]);
        $object = $response->json();
        $this->checkOnError($object);
        return $object['transaction_id'];
    }

    public function pre_confirm($card_token, $transaction_id, $card_number = null, $expiry = null)
    {
        $data = [
            'card_token' => $card_token,
            'card_number' => $card_number,
            'expiry' => $expiry,
            'store_id' => $this->store_id,
            'transaction_id' => $transaction_id
        ];
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->withBody(json_encode($data), "application/json")->post(self::SERVER . 'pre-confirm');
        Log::info("PRE CONFIRM!!!!");
        Log::info($response->body());
        $object = $response->json();
        $this->checkOnError($object);
        return $response->json();
    }

    public function confirm($transaction_id, $otp = null)
    {
        $data = [
            'transaction_id' => $transaction_id,
            'otp' => $otp,
            'store_id' => $this->store_id
        ];
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->withBody(json_encode($data), "application/json")->post(self::SERVER . 'confirm');
        $object = $response->json();
        Log::info("CONFIRM");
        Log::info($response->body());
//        try {
        // if it is okay , go on
        isset($object['store_transaction'])
        && $object['store_transaction']['status_code'] == 0
        || $this->checkOnError($object);
//        } catch (CardServiceError $exception) {
//            Log::info($exception->getMessage());
//            return $this->get($transaction_id);
//        }
        return $object;
    }

    public function otp_resend($transaction_id)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->post(self::SERVER . 'otp-resend', [
            'transaction_id' => $transaction_id,
        ]);
        $object = $response->json();
        $this->checkOnError($object);
        return $object;
    }

    public function reverse($transaction_id, $hold_amount = 0, $reason = "")
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->post(self::SERVER . 'reverse', [
            'transaction_id' => $transaction_id,
            'reason' => $reason,
            'hold_amount' => $hold_amount
        ]);
        $object = $response->json();
        Log::info($response->body());
        $this->checkOnError($object);
        return $object;
    }

    public function get($transaction_id)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->post(self::SERVER . 'get', [
            'store_id' => $this->store_id,
            'transaction_id' => $transaction_id
        ]);
        $object = $response->json();
        Log::info($response->body());
        $this->checkOnError($object);
        return $object;
    }
}
