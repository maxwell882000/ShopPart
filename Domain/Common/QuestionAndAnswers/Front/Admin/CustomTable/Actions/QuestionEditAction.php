<?php

namespace App\Domain\Common\QuestionAndAnswers\Front\Admin\CustomTable\Actions;

use App\Domain\Common\QuestionAndAnswers\Front\Admin\Path\QuestionAndAnswerRouteHandler;
use App\Domain\Core\Front\Admin\CustomTable\Actions\Abstracts\EditActionAbstract;
use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;

class QuestionEditAction extends EditActionAbstract
{

    public function getRouteHandler(): RouteHandler
    {
        return QuestionAndAnswerRouteHandler::new();
    }
}
