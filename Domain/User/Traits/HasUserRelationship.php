<?php

namespace App\Domain\User\Traits;

use App\Domain\User\Entities\User;

trait HasUserRelationship
{
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
