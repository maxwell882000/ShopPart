<?php

namespace App\Domain\User\Entities;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\User\Interfaces\SexInterface;
use App\Domain\User\Traits\HasUserRelationship;

class UserCreditData extends Entity implements SexInterface
{
    use HasUserRelationship;

    protected $table = 'user_credit_datas';

    public function crucialData()
    {
        return $this->belongsTo(CrucialData::class, "crucial_data_id");
    }

    public function getSexShowAttribute()
    {
        return __(self::DB_TO_FRONT[$this->sex] ?? "");
    }

    public function __get($key)
    {
        if ($parent = parent::__get($key)) {
            return $parent;
        }
        if (isset($this->crucialData[$key]))
            return $this->crucialData[$key];
        return null;
    }

    public function __set($name, $value)
    {
        if (isset($this[$name])) {
            $this->setAttribute($name, $value);
        } else if ($this->crucialData) {
            $this->crucialData[$name] = $value;
        }
    }
}
