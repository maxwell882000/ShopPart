<?php

namespace App\Domain\Core\UuidKey\Traits;

trait HasUniqueId
{
    protected static function bootHasUniqueId()
    {
        static::creating(function ($entity) {
            $entity->setAttribute($entity->getPrimary(), $entity->generateUniqueKey());
        });
    }

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->incrementing = $this->isIncrementing();
    }

    public function isIncrementing(): bool
    {
        return false;
    }

    public function getPrimary(): string
    {
        return "id";
    }

    protected function generateUniqueKey(): int
    {
        $max = 18446744073709551615;
        while (self::where($this->getPrimary(), $rand = rand(1000000, intval($max)))->exists()) ;
        return $rand;
    }
}
