<?php

namespace App\Domain\Common\QuestionAndAnswers\Front\Main;

use App\Domain\Common\QuestionAndAnswers\Entities\Question;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\Input\InputLangAttribute;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\TextAreaLangAttribute;
use App\Domain\Core\Front\Admin\Form\Interfaces\CreateAttributesInterface;
use App\Domain\Core\Front\Admin\Templates\Models\BladeGenerator;

class QuestionCreate extends Question implements CreateAttributesInterface
{

    public function generateAttributes(): BladeGenerator
    {
        return BladeGenerator::generation([
            new InputLangAttribute("question", "Вопросы"),
            new TextAreaLangAttribute("answer", "Ответы")
        ]);
    }
}
