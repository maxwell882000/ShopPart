<?php

namespace App\Domain\Common\QuestionAndAnswers\Builders;

use App\Domain\Core\Main\Builders\BuilderEntity;

class QuestionBuilder extends BuilderEntity
{
    protected function getSearch(): string
    {
        return "question";
    }
}
