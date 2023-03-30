<?php

namespace App\Domain\Common\QuestionAndAnswers\Front\Admin\CustomTable\Actions;

use App\Domain\Common\QuestionAndAnswers\Front\Admin\Path\QuestionAndAnswerRouteHandler;
use App\Domain\Core\Front\Admin\CustomTable\Actions\Abstracts\DeleteActionAbstract;
use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;

class QuestionDeleteAction extends DeleteActionAbstract
{

    public function getRouteHandler(): RouteHandler
    {
        return QuestionAndAnswerRouteHandler::new();
    }
}
