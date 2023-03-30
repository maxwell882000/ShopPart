<?php

namespace App\Domain\Installment\CustomInstallment\Front\Admin\Functions;

use App\Domain\Core\Api\CardService\BindCard\Error\BindCardError;
use App\Domain\Core\Api\CardService\BindCard\Model\BindCardService;
use App\Domain\Core\Api\CardService\Error\CardServiceError;
use App\Domain\Core\Front\Admin\Livewire\Functions\Abstracts\AbstractFunction;
use App\Domain\Installment\CustomInstallment\Services\OnlyPlasticCardService;
use App\Domain\User\Entities\PlasticCard;
use App\Domain\User\Services\PlasticCardService;
use App\Http\Livewire\Admin\Base\Abstracts\BaseEmptyLivewire;

// if it is already exists just find and give plastic_id, or create if not in db and give plastic_id
// if it not exists , open dialog
class SendCodeForPlasticLivewire extends AbstractFunction
{
    const SEND_SMS = "sendSms()";
    const GET_CODE = "getCode()";
    private ?BaseEmptyLivewire $livewire;
    private PlasticCardService $service;

    public function __construct(?BaseEmptyLivewire $livewire = null)
    {
        $this->livewire = $livewire;
        $this->service = new OnlyPlasticCardService();
    }

    private function validate()
    {
        $this->livewire->validate([
            'card_number' => "required|min:19",
            'date_number' => "required|min:5|max:5"
        ]);
    }

    private function setPlasticIdDB()
    {
        $object = str_replace(" ", "", $this->livewire->card_number);
        $card = PlasticCard::where('card_number', $object);
        if ($card->exists()) {
            $this->livewire->plastic_id = $card->first()->id;
            session()->flash('success', 'Карта успешно обработана!');
            $this->sendPhone($card->first()->phone);
        }
    }

    private function createPlastic(array $object_data)
    {
        $object_data['card_number'] = $this->livewire->card_number;
        $plastic = $this->service->create($object_data);
        $this->livewire->plastic_id = $plastic->id;
        $this->sendPhone($plastic->phone);
    }

    private function sendPhone($value)
    {
        $this->livewire->dispatchBrowserEvent("plastic-phone", ["value" => $value]);
    }

    private function setPlasticIdPaymo()
    {
        if (!$this->livewire->plastic_id) {
            try {
                $service = new BindCardService();
                $this->livewire->transaction_id = $service->create(
                    $this->livewire->card_number,
                    $this->livewire->date_number);
                session()->flash('success', 'Код успешно отправлен!');
                $this->livewire->dispatchBrowserEvent('open-dialog');
            } catch (BindCardError $error) {
                $plastic_data = json_decode($error->getMessage(), true);
                $this->createPlastic(['plastic_data' => $plastic_data]);
                session()->flash("success", "Карта успешно добавлена");
            } catch (CardServiceError $error) {
                $this->livewire->addError("bind", $error->getMessage());
            }
        }
    }

    public function openOrSetPlasticId()
    {
        $this->validate();
        $this->setPlasticIdDB();
        $this->setPlasticIdPaymo();
    }

    public function createThroughCode()
    {
        $this->createPlastic([
            'transaction_id' => $this->livewire->transaction_id,
            "code" => $this->livewire->code
        ]);
    }

    public static function sendSms(BaseEmptyLivewire $dynamic)
    {
//        dd($dynamic);
        $class = new static($dynamic);
        $class->openOrSetPlasticId();
    }

    public static function getCode(BaseEmptyLivewire $dynamic)
    {
        $class = new static($dynamic);
        $class->createThroughCode();
        $dynamic->dispatchBrowserEvent("close-dialog");
    }
}
