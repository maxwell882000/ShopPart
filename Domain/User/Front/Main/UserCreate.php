<?php

namespace App\Domain\User\Front\Main;

use App\Domain\Core\Front\Admin\Form\Attributes\Models\Input\InputAttribute;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\Input\InputFileTempAttribute;
use App\Domain\Core\Front\Admin\Form\Interfaces\CreateAttributesInterface;
use App\Domain\Core\Front\Admin\Templates\Models\BladeGenerator;
use App\Domain\User\Entities\User;
use App\Domain\User\Front\Admin\DropDown\SexDropDown;
use App\Domain\User\Interfaces\UserRelationInterface;

class UserCreate extends User implements CreateAttributesInterface
{

    public function generateAttributes(): BladeGenerator
    {
        return BladeGenerator::generation([
            InputAttribute::init(self::AVATAR_DATA . "name", "text", "Никнейм"),
            new InputAttribute("phone", "text", "Телефон пользователя"),
            new InputAttribute(UserRelationInterface::USER_DATA
                . 'additional_phone',
                "text",
                "Дополнительный телефон"),
            new InputAttribute("password", "password", "Пароль"),


            new InputAttribute(
                UserRelationInterface::CRUCIAL_DATA
                . "firstname",
                "text", "Имя пользователя"),
            new InputAttribute(
                UserRelationInterface::CRUCIAL_DATA
                . "lastname",
                "text", "Фамилия пользователя"),
            new InputAttribute(
                UserRelationInterface::CRUCIAL_DATA
                . "father_name",
                "text", "Отчество пользователя"),
            SexDropDown::new(),
            new InputAttribute(
                UserRelationInterface::CRUCIAL_DATA
                . 'series',
                "text", "Паспорт серия"),
            new InputAttribute(
                UserRelationInterface::CRUCIAL_DATA
                . 'date_of_birth',
                "date", "Дата рождения"),
            new InputAttribute(
                UserRelationInterface::CRUCIAL_DATA
                . 'pnfl',
                "text", "ПНФЛ"),
            new InputFileTempAttribute(
                UserRelationInterface::AVATAR_DATA
                . 'avatar',
                "Аватар"),
            new InputFileTempAttribute(
                UserRelationInterface::CRUCIAL_DATA
                . 'passport',
                "Паспорт"),
            new InputFileTempAttribute(
                UserRelationInterface::CRUCIAL_DATA
                . "passport_reverse",
                "Прописка"),
            new InputFileTempAttribute(
                UserRelationInterface::CRUCIAL_DATA
                . "user_passport",
                "Паспорт c пользователем"),


        ]);
    }


}
