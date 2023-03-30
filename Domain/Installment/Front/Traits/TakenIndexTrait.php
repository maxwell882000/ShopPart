<?php

namespace App\Domain\Installment\Front\Traits;

use App\Domain\Core\Front\Admin\Blade\Base\AllBladeActions;
use App\Domain\Core\Front\Admin\CustomTable\Attributes\Attributes\ContainerTextAttribute;
use App\Domain\Core\Front\Admin\CustomTable\Attributes\Attributes\TextAttribute;
use App\Domain\Core\Front\Admin\CustomTable\Traits\TableFilterBy;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireComponents;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireFunctions;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireOptionalDropDown;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireAdditionalFunctions;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireComponents;

trait TakenIndexTrait
{
    use TableFilterBy;

//    public function getStatusIndexAttribute()
//    {
//
//    }
    public function getRowStyleAttribute()
    {
        if ($this->isNotPaid()) {
            return "bg-red-200 text-gray-700";
        }
        return "";
    }

    public function getAllSumIndexAttribute()
    {
        return TextAttribute::generation($this, "price_show");
    }

    public function getSaldoIndexAttribute()
    {
        return TextAttribute::generation($this, "saldo_show");
    }

    public function getRestIndexAttribute()
    {
        return TextAttribute::generation($this, $this->restToPayShow() ?? "", true);
    }

    public function getDateCreationIndexAttribute()
    {
        return TextAttribute::generation($this, $this->created_at, true);
    }

    public function getDateApprovalIndexAttribute()
    {
        $date_taken = $this->date_taken;
        if ($this->date_taken)
            $date_taken = $this->dateApproval();
        return TextAttribute::generation($this, $date_taken, true);
    }

    public function getDateFinishIndexAttribute()
    {
        return TextAttribute::generation($this, $this->date_finish, true);
    }

    private function dateApproval()
    {
        return \Carbon\Carbon::parse($this->date_taken)->format("d.m.Y");
    }

    public function getStatusIndexAttribute()
    {
        $class = "";
        $text = "";
        switch ($this->status) {
            case self::WAIT_ANSWER:
                $class = "bg-blue-400";
                $text = "Ожидается";
                break;
            case  self::ACCEPTED:
                $class = "bg-green-400";
                $text = __("Принят") . " (" . $this->dateApproval() . ")";
                break;
            case self::DECLINED:
                $class = "bg-red-400";
                $text = "Отказано";
                break;
            case self::NOT_PAID:
                $class = "bg-red-400";
                $text = "Не оплачено";
                break;
            case self::ANNULLED:
                $class = "bg-red-400";
                $text = "Анулировоно";
                break;
            case self::REQUIRED_SURETY:
                $class = "bg-blue-400";
                $text = "Поручитель";
                break;
            case self::FINISHED:
                $class = "bg-green-500";
                $text = "Закончено";
                break;
        }
        return ContainerTextAttribute::generation(
            $class,
            new TextAttribute(
                $this,
                $text,
                true));
    }

    public function setStatusHandleAttribute($value)
    {

    }


    public function livewireComponents(): LivewireComponents
    {
        return AllLivewireComponents::generation([

        ]);
    }

    public function livewireOptionalDropDown(): AllLivewireOptionalDropDown
    {
        return AllLivewireOptionalDropDown::generation(
            [

            ]
        );
    }


    public function livewireFunctions(): LivewireAdditionalFunctions
    {
        return AllLivewireFunctions::generation([

        ]);
    }

    public function getBladeActions(): string
    {
        return AllBladeActions::generation([
        ]);
    }

    function filterByData(): array
    {
        return [
            "filter" => true,
            "not_waited" => true,
        ];
    }
}
