<?php

namespace App\Domain\Installment\Services;

use App\Domain\Installment\Entities\TimeScheduleTransactions;
use App\Domain\Installment\Interfaces\TimeScheduleInterface;
use   \Illuminate\Support\Facades\Log;
class TimeScheduleService
{
    const FAILED_ALL = "Снятие денег со всех возможных карточек не удалась";
    const FAILED_ONE = "Cнятие денег с карточки номера %s не удалась. По причине %s";
    const FAILED_LOOP = self::FAILED_ONE . " " . "Повторная попытка будет через 2 часа";
    const SUCCESS = "Успешно снял деньги с карточки %s";
    const TIME_SCHEDULE_CLASS = TimeScheduleTransactions::class;

    static private function create($numberCard, $reason, $template, $taken_id, $status)
    {
        $var = static::TIME_SCHEDULE_CLASS;
        Log::info("TAKEN_CREDIT _ID IS");
    
        $detail = sprintf($template, $numberCard, $reason);
        Log::info($detail);
        Log::info($status);
        Log::info($taken_id);
        $var::create([
            'detail' => $detail ,
            'status' => $status,
            'taken_credit_id' => $taken_id
        ]);
        Log::info("is okay");
    }

    static public function failed($numberCard, $reason, $taken_id)
    {
        self::create($numberCard, $reason, self::FAILED_ONE, $taken_id, TimeScheduleInterface::FAILED);
    }

    static public function failedAll($taken_id)
    {
        self::create("", "", self::FAILED_ALL, $taken_id, TimeScheduleInterface::FAILED_ALL);
    }

    static public function failedLoop($numberCard, $reason, $taken_id)
    {
        self::create($numberCard, $reason, self::FAILED_LOOP, $taken_id, TimeScheduleInterface::FAILED_LOOP);
    }

    static public function success($numberCard, $taken_id)
    {
        self::create($numberCard, "", self::SUCCESS, $taken_id, TimeScheduleInterface::SUCCESS);
    }
}
