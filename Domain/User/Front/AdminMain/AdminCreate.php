<?php

namespace App\Domain\User\Front\AdminMain;

use App\Domain\Core\Front\Admin\Form\Attributes\Models\Input\InputAttribute;
use App\Domain\Core\Front\Admin\Form\Interfaces\CreateAttributesInterface;
use App\Domain\Core\Front\Admin\Templates\Models\BladeGenerator;
use App\Domain\User\Entities\User;
use App\Domain\User\Front\Admin\DropDown\RoleDropDown;

class AdminCreate extends User implements CreateAttributesInterface
{

    public function generateAttributes(): BladeGenerator
    {
        return BladeGenerator::generation([
            new InputAttribute("phone", "text", "Телефон пользователя"),
            new InputAttribute("password", "password", "Пароль"),
            RoleDropDown::new()
        ]);
    }
}
