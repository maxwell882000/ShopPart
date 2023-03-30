<?php

namespace App\Domain\Common\QuestionAndAnswers\Api;

use App\Domain\Common\QuestionAndAnswers\Entities\Question;

class QuestionApi extends Question
{
    public function toArray()
    {
        return [
            "id" => $this->id,
            "question" => $this->question_current,
            "answer" => $this->answer_current
        ];
    }
}
