<?php

namespace App\Domain\Common\QuestionAndAnswers\Front\Main;

use App\Domain\Common\QuestionAndAnswers\Entities\Question;
use App\Domain\Common\QuestionAndAnswers\Front\Admin\CustomTable\Actions\QuestionDeleteAction;
use App\Domain\Common\QuestionAndAnswers\Front\Admin\CustomTable\Actions\QuestionEditAction;
use App\Domain\Common\QuestionAndAnswers\Front\Admin\CustomTable\Tables\QuestionTable;
use App\Domain\Core\File\Models\Livewire\FileLivewireCreator;
use App\Domain\Core\Front\Admin\CustomTable\Actions\Base\AllActions;
use App\Domain\Core\Front\Admin\CustomTable\Attributes\Attributes\TextAttribute;
use App\Domain\Core\Front\Admin\CustomTable\Interfaces\TableInFront;
use App\Domain\Core\Front\Admin\Form\Interfaces\CreateAttributesInterface;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireComponents;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireFunctions;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireOptionalDropDown;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireAdditionalFunctions;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireComponents;
use App\Domain\Core\Front\Admin\Templates\Models\BladeGenerator;

class QuestionIndex extends Question implements TableInFront, CreateAttributesInterface
{

    public function getQuestionIndexAttribute()
    {
        return TextAttribute::generation($this, "question_current");
    }

    public function getAnswerIndexAttribute()
    {
        return TextAttribute::generation($this, substr($this->getAnswerCurrentAttribute(), 0, 30), true);
    }

    public function generateAttributes(): BladeGenerator
    {
        return BladeGenerator::generation([
            new   FileLivewireCreator("QuestionIndex", $this)
        ]);
    }

    public function livewireFunctions(): LivewireAdditionalFunctions
    {
        return AllLivewireFunctions::generation([

        ]);
    }

    public function getActionsAttribute(): string
    {
        return AllActions::generation([
            QuestionEditAction::new([$this->id]),
            QuestionDeleteAction::new([$this->id])
        ]);
    }

    public function getTableClass(): string
    {
        return QuestionTable::class;
    }

    public function livewireComponents(): LivewireComponents
    {
        return AllLivewireComponents::generation([

        ]);
    }

    public function livewireOptionalDropDown(): AllLivewireOptionalDropDown
    {
        return AllLivewireOptionalDropDown::generation([

        ]);
    }

    public function getTitle(): string
    {
        return "Вопросы и ответы";
    }
}
