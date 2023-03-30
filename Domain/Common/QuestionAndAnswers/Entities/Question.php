<?php

namespace App\Domain\Common\QuestionAndAnswers\Entities;

use App\Domain\Common\QuestionAndAnswers\Builders\QuestionBuilder;
use App\Domain\Core\Language\Traits\Translatable;
use App\Domain\Core\Main\Entities\Entity;

class Question extends Entity
{
    use Translatable;

    protected $table = "question_and_answers";

    public function newEloquentBuilder($query): QuestionBuilder
    {
        return new QuestionBuilder($query);
    }

    public function setQuestionAttribute($value)
    {
        $this->setTranslate("question", $value);
    }

    public function getQuestionAttribute(): ?\Illuminate\Support\Collection
    {
        return $this->getTranslations("question");
    }

    public function getQuestionCurrentAttribute(): ?string
    {
        return $this->getTranslatable("question");
    }

    public function setAnswerAttribute($value)
    {
        $this->setTranslate("answer", $value);
    }

    public function getAnswerAttribute(): ?\Illuminate\Support\Collection
    {
        return $this->getTranslations("answer");
    }

    public function getAnswerCurrentAttribute(): ?string
    {
        return $this->getTranslatable("answer");
    }

}
