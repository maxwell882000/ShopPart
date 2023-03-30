<?php

namespace App\Domain\Common\QuestionAndAnswers\Front\Admin\File;

use App\Domain\Common\QuestionAndAnswers\Entities\Question;
use App\Domain\Common\QuestionAndAnswers\Front\Main\QuestionCreate;
use App\Domain\Common\QuestionAndAnswers\Front\Main\QuestionEdit;
use App\Domain\Common\QuestionAndAnswers\Front\Main\QuestionIndex;
use App\Domain\Core\File\Factory\MainFactoryCreator;

class QuestionFileCreator extends MainFactoryCreator
{

    public function getEntityClass(): string
    {
        return Question::class;
    }

    public function getIndexEntity(): string
    {
        return QuestionIndex::class;
    }

    public function getCreateEntity(): string
    {
        return QuestionCreate::class;
    }

    public function getEditEntity(): string
    {
        return QuestionEdit::class;
    }
}
