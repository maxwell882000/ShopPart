<?php

namespace App\Domain\Delivery\Api\Interfaces;

use App\Domain\Delivery\Interfaces\DeliveryStatus;
use phpDocumentor\Reflection\Types\Self_;

interface DpdExceptionInterface extends DeliveryStatus
{
    /**
     * write all possible error message code that could be given
     */


    const OK = "OK";
    const ORDER_PENDING = "OrderPending";
    const ORDER_DUPLICATE = "OrderDuplicate";
    const ORDER_ERROR = "OrderError";
    const ORDER_CANCELED = "OrderCancelled";

    const CANCELED = "Canceled";
    const CANCELED_PREVIOUSLY = "CanceledPreviously";
    const CALL_DPD = "CallDPD";
    const NOT_FOUND = "NotFound";
    const ERROR = "Error";
    const CANCELED_DB = -1;
    const PREVIOUSLY_CALLED_DB = -2;
    const CALL_DPD_DB = -3;
    const NOT_FOUND_DB = -4;
    const ERROR_DB = -5;

    const EXCEPTION = [
        self::CANCELED_PREVIOUSLY => "Отменено ранее",
        self::CALL_DPD => "Состояние заказа не позволяет отменить заказ самостоятельно, для отмены заказа необходим звонок в Конткат-Центр.",
        self::NOT_FOUND => "Данные не найдены"
    ];
    const ERROR_STATUS_TO_DB = [
        self::CANCELED_PREVIOUSLY => self::PREVIOUSLY_CALLED_DB,
        self::CALL_DPD => self::CALL_DPD_DB,
        self::NOT_FOUND => self::NOT_FOUND_DB,
        self::ERROR => self::ERROR_DB,
    ];
    const STATUS_TO_DB = [
        self::OK => self::CREATED,
        self::ORDER_PENDING => self::DELIVERY_PENDED,
        self::CANCELED => self::CANCELED_DB,
    ];
    const DB_TO_FRONT  = [
        self::CREATED => "Успешно принят",
        self::DELIVERY_PENDED => "Заказ обрабатываеться в ручную !",
        self::CANCELED_DB => "Отменён",
    ];
}
