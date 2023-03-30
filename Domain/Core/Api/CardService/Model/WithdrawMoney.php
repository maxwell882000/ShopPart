<?php

namespace App\Domain\Core\Api\CardService\Model;

use App\Domain\Core\Api\CardService\Error\CardServiceError;
use App\Domain\Core\Api\CardService\Interfaces\Payable;
use App\Domain\Core\Api\CardService\Merchant\Model\Merchant;

class WithdrawMoney
{
    private Merchant $merchant;
    private Payable $payable;
    private $transaction_id;

    public function __construct(Payable $payable)
    {
        $this->merchant = new Merchant();
        $this->payable = $payable;
    }

    public function getPayable()
    {
        return $this->payable;
    }

    public function getToken($token = null)
    {
        return $token ?? $this->payable->getTokens()->first();
    }

    private function checkBeforeWithdraw()
    {
        if (!$this->payable->check()) {
            throw new CardServiceError(__("Запрещено снимать деньги"));
        }
    }

    public function saveWithdraw()
    {
        try {
            $this->withdraw();
        } catch (CardServiceError $exception) {
            $this->reverseSave();
            throw $exception;
        }
    }

    private function setTransaction($confirm)
    {
        $this->payable->setTransaction($confirm['store_transaction']['success_trans_id']);
    }

    public function withdraw($token = null, $amount = null): bool
    {
        $this->checkBeforeWithdraw();
        $token = $this->getToken($token);
        $this->transaction_id = $this->merchant->create($amount ?? $this->payable->amount(), $this->payable->account_id());
        $this->merchant->pre_confirm($token,$this->transaction_id);
        $confirm = $this->merchant->confirm($this->transaction_id);
        $this->convertAmount($confirm);
        $this->setTransaction($confirm);
        return $this->payable->finishTransaction($confirm);
    }

    private function convertAmount(array &$object)
    {
        $object['store_transaction']['amount'] = $object['store_transaction']['amount'] / 100;
    }

    private function _reverse($hold_money = 0, $transaction = null)
    {
        if ($this->payable->getTransaction())
            $this->merchant->reverse($transaction, $hold_money);
        else if ($hold_money != 0 && !$transaction) {
            throw new CardServiceError(__("Должен снять деньги, но начального взноса нету"), CardServiceError::NOT_INITIAL_PAY);
        }
    }

    public function reverse($hold_money = 0)
    {
        $this->_reverse($hold_money, $this->payable->getTransaction());
    }

    public function reverseSave()
    {
        $this->_reverse(0, $this->transaction_id);
    }
}
