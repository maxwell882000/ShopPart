<?php

namespace App\Domain\Common\QuestionAndAnswers\Front\Admin\CustomTable\Tables;

use App\Domain\Common\QuestionAndAnswers\Front\Admin\Path\QuestionAndAnswerRouteHandler;
use App\Domain\Core\Front\Admin\Attributes\Models\Column;
use App\Domain\Core\Front\Admin\CustomTable\Abstracts\AbstractCreateTable;
use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;

class QuestionTable extends AbstractCreateTable
{

    public function getRouteHandler(): RouteHandler
    {
        return QuestionAndAnswerRouteHandler::new();
    }

    public function getColumns(): array
    {
        return [
            Column::new(__("Вопросы"), "question_index"),
            Column::new(__("Ответы"), "answer_index")
        ];
    }
}
