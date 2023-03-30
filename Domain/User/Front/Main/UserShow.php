<?php

namespace App\Domain\User\Front\Main;

use App\Domain\Core\File\Models\Livewire\FileLivewireCreatorWithFilterBy;
use App\Domain\Core\Front\Admin\Attributes\Containers\Container;
use App\Domain\Core\Front\Admin\Attributes\Containers\ContainerColumn;
use App\Domain\Core\Front\Admin\Attributes\Containers\ContainerRow;
use App\Domain\Core\Front\Admin\Attributes\Containers\NestedContainer;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\ImageCompileAttribute;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\KeyTextAttribute;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\KeyTextLinkDownloadAttribute;
use App\Domain\Core\Front\Admin\Form\Interfaces\CreateAttributesInterface;
use App\Domain\Core\Front\Admin\Templates\Models\BladeGenerator;
use App\Domain\Installment\Front\Nested\TakenCreditFiltered;
use App\Domain\User\Entities\User;
use App\Domain\User\Interfaces\UserRelationInterface;

class UserShow extends User implements CreateAttributesInterface
{

    public function generateAttributes(): BladeGenerator
    {
        return BladeGenerator::generation([
            ContainerColumn::new([
                'class' => "space-y-10"
            ], [
                ContainerRow::new(['class' => "space-x-10 "], [
                    ContainerRow::new([
                        "class" => "space-x-10 flex-1 bg-white items-center shadow-lg rounded p-10"
                    ], [
                        Container::new([], [
                            ImageCompileAttribute::new(
                                self::AVATAR_DATA . 'avatar',
                                [
                                    'class' => "w-32 h-32"
                                ]),
                        ]),
                        Container::new([],
                            [
                                KeyTextAttribute::new(__("Имя клиента"), self::CRUCIAL_DATA . 'name'),
                                KeyTextAttribute::new(__("Телефон"), "phone"),
                                KeyTextAttribute::new(__("Дополнительный номер"), self::USER_DATA . 'additional_phone'),
                                KeyTextAttribute::new(__("Пол"), UserRelationInterface::USER_DATA . "sex_show"),
                                KeyTextAttribute::new(__("Дата рождения"), self::CRUCIAL_DATA
                                    . 'date_of_birth')
                            ]),
                    ]),
                    Container::new([
                        'class' => "items-center bg-white shadow-lg rounded p-10"
                    ], [
                        KeyTextAttribute::new(__("Серия паспорта"), self::CRUCIAL_DATA . 'series'),
                        KeyTextAttribute::new('ПНФЛ', self::CRUCIAL_DATA . 'pnfl'),
                        KeyTextLinkDownloadAttribute::newLink(__("Паспорт"), __("Скачать"),
                            UserRelationInterface::CRUCIAL_DATA . 'passport'),
                        KeyTextLinkDownloadAttribute::newLink(__("Прописка"), __("Скачать"),
                            UserRelationInterface::CRUCIAL_DATA
                            . "passport_reverse"),
                        KeyTextLinkDownloadAttribute::newLink(__("Паспорт c пользователем"), __("Скачать"),
                            UserRelationInterface::CRUCIAL_DATA
                            . "user_passport"),
                    ]),
                ]),
                NestedContainer::new("__(\"Рассрочки\")", [
                    new FileLivewireCreatorWithFilterBy("UserShow", TakenCreditFiltered::new()),
                ])
            ])
        ]);
    }

    public function getTitle(): string
    {
        return "Пользователь";
    }
}
