<?php

namespace App\Domain\Comments\Entities;

use App\Domain\Comments\Builders\CommentBuilder;
use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Product\Product\Entities\Product;
use App\Domain\User\Entities\User;
use App\Domain\User\Traits\HasUserRelationship;

class CommentProduct extends Entity
{
    use HasUserRelationship;

    protected $table = "comment_product";
    public $timestamps = true;
    protected $fillable = [
        "user_id",
        "product_id",
        "status",
        "message",
        "created_at",
        "updated_at"
    ];

    public function newEloquentBuilder($query)
    {
        return new CommentBuilder($query);
    }

    public function product()
    {
        return $this->belongsTo(Product::class, "product_id");
    }

    private function disOrLike(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class,
            "comment_product_likes",
            "comment_id",
            "user_id");
    }

    public function likes()
    {
        return $this->disOrLike()->where("status", true);
    }

    public function dislikes()
    {
        return $this->disOrLike()->where("status", false);
    }
}
