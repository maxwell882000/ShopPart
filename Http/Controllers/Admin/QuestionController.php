<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Common\QuestionAndAnswers\Entities\Question;
use App\Domain\Common\QuestionAndAnswers\Front\Admin\Path\QuestionAndAnswerRouteHandler;
use App\Domain\Common\QuestionAndAnswers\Services\QuestionService;
use App\Domain\Core\Front\Admin\Form\Abstracts\AbstractForm;
use App\Domain\Core\Front\Admin\Form\Models\FormForModel;
use App\Domain\Core\Main\Services\BaseService;
use App\Http\Controllers\Base\Abstracts\BaseController;
use Illuminate\Http\Request;

class QuestionController extends BaseController
{
    public function getEntityClass(): string
    {
        return Question::class;
    }

    public function getService(): BaseService
    {
        return QuestionService::new();
    }

    public function getForm(): AbstractForm
    {
        return FormForModel::new(QuestionAndAnswerRouteHandler::new(), "Вопросы и ответы");
    }

    public function edit(Request $request, Question $question)
    {
        return $this->getEdit($request, $question, [$question]);
    }

    public function update(Request $request, Question $question): \Illuminate\Http\RedirectResponse
    {
        return $this->getUpdateValidation($request, $question);
    }

    public function destroy(Question $question): \Illuminate\Http\RedirectResponse
    {
        return $this->getDestroy($question);
    }
}
