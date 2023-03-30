<?php

namespace App\Domain\Common\QuestionAndAnswers\Services;

use App\Domain\Common\QuestionAndAnswers\Entities\Question;
use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Main\Services\BaseService;

class QuestionService extends BaseService
{
    public function getEntity(): Entity
    {
        return Question::new();
    }
}
