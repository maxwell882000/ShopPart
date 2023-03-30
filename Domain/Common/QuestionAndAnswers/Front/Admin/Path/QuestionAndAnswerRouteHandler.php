<?php

namespace App\Domain\Common\QuestionAndAnswers\Front\Admin\Path;

use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;
use App\Domain\Core\Front\Admin\Routes\Routing\AdminRoutesInterface;

class QuestionAndAnswerRouteHandler extends RouteHandler
{
    protected function getName(): string
    {
        return AdminRoutesInterface::QUESTION;
    }
}
