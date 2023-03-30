<?php

namespace App\Domain\User\Front\Admin\CustomTable\Tables;

use App\Domain\Core\Front\Admin\Attributes\Models\Column;
use App\Domain\Core\Front\Admin\Button\ModelInRunTime\ButtonBlueLivewire;
use App\Domain\Core\Front\Admin\CustomTable\Abstracts\AbstractDynamicTable;
use App\Domain\User\Entities\PlasticCard;
use App\Domain\User\Front\Admin\Functions\SendSmsLivewire;
use App\Domain\User\Front\Dynamic\PlasticCardDynamic;

class PlasticDynamicTable extends AbstractDynamicTable
{
    public function getInputs(): array
    {
        return $this->generateInput(PlasticCard::getRules());
    }

    public function getActions(): array
    {
        return [
            ButtonBlueLivewire::new('Отправить сообщение', SendSmsLivewire::FUNCTION_NAME),
        ];
    }

    public static function setInputAttr($key, $type)
    {
        return PlasticCardDynamic::setInputAttr($key, $type);
    }

    public function getColumns(): array
    {
        return [
            new Column(__("Номер карты"), "card_number-index"),
            new Column(__("Дата истечения"), "date_number-index"),
            new Column(__("Смс код"), "code-index"),
        ];
    }
}
