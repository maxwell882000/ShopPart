<?php

namespace App\Domain\Comments\Api;

use App\Domain\Comments\Entities\CommentProduct;
use Illuminate\Support\Carbon;

class CommentApi extends CommentProduct
{
    public function getCreatedAtAttribute($date)
    {
        if ($date)
            return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
        return "";
    }

    public function toArray()
    {
        return [
            "id" => $this->id,
            "name" => $this->user->avatar->name,
            "avatar" => $this->user->avatar->avatar->fullPath(),
            "mark" => $this->product->mark()->wherePivot("user_id", $this->user_id)->first()->pivot->mark,
            "created_at" => $this->created_at,
            "message" => $this->message,
            "num_likes" => $this->likes()->count(),
            "num_dislikes" => $this->dislikes()->count()
        ];
    }
}
