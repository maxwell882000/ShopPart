<?php

namespace App\Http\Controllers\Api\QuestionAndAnswer;

use App\Domain\Common\QuestionAndAnswers\Api\QuestionApi;
use App\Http\Controllers\Api\Base\ApiController;

class QuestionController extends ApiController
{
    public function index()
    {
        return $this->result([
            "question" => QuestionApi::all()
        ]);
    }
}
