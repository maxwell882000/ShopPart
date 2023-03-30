<?php

namespace App\Domain\Telegrams\Schedule;

use App\Domain\Core\BackgroundTask\Base\AbstractSchedule;
use App\Domain\Telegrams\Entities\Telegram as Entity;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramSchedule extends AbstractSchedule
{
    public function call()
    {
        return parent::call()->everyTenMinutes();
    }

    public function run()
    {
        $object = Telegram::getUpdates();
        foreach ($object as $item) {
            $chat = $item['message']['chat']['id'];
            Entity::firstOrCreate(['chat_id' => $chat]);
        }
    }
}
