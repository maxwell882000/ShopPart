<?php

namespace App\Domain\User\Traits;

use App\Domain\Core\UuidKey\Traits\HasUuidKey;

trait PlasticCardTrait
{
    use HasUuidKey;

    public function getExpiryAttribute()
    {
        $pan = $this->attributes['expiry'];
        return substr($pan, 2) . "/" . substr($pan, 0, 2);
    }

    public static function getRules(): array
    {
        return [
            'card_number' => "required",
            "date_number" => "required",
            "code" => "integer"
        ];
    }
}
