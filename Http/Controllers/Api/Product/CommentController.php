<?php

namespace App\Http\Controllers\Api\Product;

use App\Domain\Comments\Api\CommentApi;
use App\Domain\Comments\Services\CommentProductService;
use App\Domain\Product\Api\ProductView;
use App\Http\Controllers\Api\Base\ApiController;
use Illuminate\Http\Request;

class CommentController extends ApiController
{
    public CommentProductService $commentProductService;

    public function __construct()
    {
        $this->commentProductService = new CommentProductService();
        parent::__construct();
    }

    public function comments(ProductView $product): \Illuminate\Http\JsonResponse
    {
        return $this->result(CommentApi::show($product)->paginate(self::SMALL_PAGINATE));
    }

    public function like(Request $request)
    {
        $this->disOrLike($request, true);
    }

    public function disLike(Request $request)
    {
        $this->disOrLike($request, false);
    }

    private function disOrLike(Request $request, $status)
    {
        $request->validate([
            'comment_id' => "required"
        ]);
        $condition = [
            "comment_id" => $request->comment_id,
            "user_id" => auth()->user()->id
        ];
        $this->commentProductService->updateOrCreate($condition, array_merge([
            'status' => $status
        ], $condition));
    }
}
