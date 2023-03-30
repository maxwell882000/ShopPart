<?php

namespace App\Domain\User\Entities;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Media\Traits\MediaTrait;
use App\Domain\User\Traits\HasUserRelationship;

/// name was added
class UserAvatar extends Entity
{
    use MediaTrait, HasUserRelationship;

    protected $table = "user_avatar";
    public $incrementing = false;
    protected $primaryKey = 'user_id';
    protected $fillable = [
        "name",
        "user_id",
        "avatar"
    ];

    public function getAvatarAttribute($value): \App\Domain\Core\Media\Models\Media
    {
        return $this->getMedia('avatar', $value, $this->user_id);
    }

    public function setAvatarAttribute($value)
    {
        $this->setMedia('avatar', $value, $this->user_id);
    }

    public function getMediaPathStorages(): string
    {
        return "user_avatar";
    }

    public function mediaKeys(): array
    {
        return [
            'avatar'
        ];
    }
}
