<?php

namespace App\Domain\Telegrams\Job;

use App\Domain\Core\BackgroundTask\Base\AbstractJob;
use App\Domain\Core\Front\Admin\Routes\Interfaces\RoutesInterface;
use App\Domain\Core\Main\Traits\ArrayHandle;
use App\Domain\Installment\Entities\TakenCredit;
use App\Domain\Installment\Front\Admin\Path\TakenCreditRouteHandler;
use App\Domain\Order\Entities\UserPurchase;
use App\Domain\Telegrams\Entities\Telegram as Entity;
use App\Domain\User\Interfaces\UserRelationInterface;
use Telegram\Bot\Laravel\Facades\Telegram;
use function Symfony\Component\Translation\t;

class TelegramJob extends AbstractJob
{
    use ArrayHandle;

    private UserPurchase $purchase;

    public function __construct(UserPurchase $purchase)
    {
        $this->purchase = $purchase;
    }

    public function handle()
    {
        $message = [
            "Имя пользователя" => $this->purchase->user[UserRelationInterface::USER_DATA_SERVICE]->name,
            "Номер Телефона" => $this->purchase->user->phone,
            "Номер Договора" => $this->purchase->id,
            'Количество покупок' => $this->purchase->number_purchase,
            'Общая цена' => $this->purchase->sumPurchases() . " cумм",
            "Вид покупки" => $this->purchase->typePayment(),
        ];
        if ($this->purchase->isInstallment()) {
            $installment = [
                "Количество месяцев" => $this->purchase->takenCredit->number_month,
                "Процент на каждый месяц" => $this->purchase->takenCredit->credit->percent,
                "Первоначальная оплата" => $this->purchase->takenCredit->initial_price . " cумм",
                "Ежемесячный платеж" => $this->purchase->takenCredit->monthly_paid . " cумм",
//                "Ссылка на рассрочку" => route((new TakenCreditRouteHandler())->getRoute(RoutesInterface::SHOW_ROUTE), [$this->purchase->takenCredit->])
            ];
            $message = array_merge($message, $installment);
        }
        foreach (Entity::all() as $item) {
            Telegram::sendMessage([
                'parse_mode' => 'HTML',
                "chat_id" => $item->chat_id,
                "text" => "<b> ======= НОВЫЙ ЗАКАЗ ======= </b> \n" . $this->arrayToHTML($message)
            ]);
        }
    }
}
