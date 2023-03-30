<?php

namespace App\Http\Controllers\Api\CommentAndMark;

use App\Domain\Comments\Api\CommentApi;
use App\Domain\Comments\Services\CommentProductService;
use App\Domain\Comments\Services\MarkProductService;
use App\Domain\Product\Product\Entities\Product;
use App\Http\Controllers\Api\Base\ApiController;
use Illuminate\Http\Request;
use function GuzzleHttp\Promise\all;

class ProductCommentMarkController extends ApiController
{
    public MarkProductService $markProductService;
    public CommentProductService $commentProductService;

    public function __construct()
    {
        $this->markProductService = new MarkProductService();
        $this->commentProductService = new CommentProductService();
        parent::__construct();
    }

    public function leftComment(Product $product)
    {
        return $this->saveResponse(function () use ($product) {
            $mark = "digits_between:1,5";
            $mark_object = $product->mark()->where("user_id", auth()->user()->id);
            if (!$mark_object->exists()) {
                $mark = $mark . "|" . "required";
            }
            $this->validateRequest([
                "message" => "required",
                "mark" => $mark
            ]);
            $condition = [
                'user_id' => auth()->user()->id,
                "product_id" => $product->id
            ];
            $this->markProductService->transaction(function () use ($condition) {
                $object_data = array_merge($this->request->all(), $condition);
                $this->markProductService->updateOrCreate($condition, $object_data);
                $this->commentProductService->create($object_data);
            });
        });
    }
}
