<?php

namespace App\Domain\User\Traits;

use App\Domain\Core\Front\Admin\File\Attributes\FileAttribute;
use App\Domain\User\Interfaces\SuretyRelationInterface;

trait HasCrucialFilesTrait
{

    public function getPassportReverseEdit($relation = "")
    {

        return new FileAttribute(
            $this->suretyRelationGet($relation),
            'passport_reverse',
            'passport_reverse_1'
        );
    }

    private function suretyRelationGet($relation = "")
    {
        if ($relation) {
            return $this[$relation][SuretyRelationInterface::CRUCIAL_DATA_SERVICE];
        }
        $object = $this[SuretyRelationInterface::CRUCIAL_DATA_SERVICE];
        if ($object) {
            return $object;
        }
        return $this;
    }

    public function getPassportUserEdit($relation = ""): FileAttribute
    {
        return new FileAttribute(
            $this->suretyRelationGet($relation),
            "user_passport",
            "passport_1",
        );
    }

    public function getPassportEdit($relation = ""): FileAttribute
    {
        return new FileAttribute(
            $this->suretyRelationGet($relation),
            'passport',
            'user_passport_1'
        );
    }

    public function getPassportReverseEditAttribute()
    {
        return $this->getPassportReverseEdit();
    }

    public function getPassportUserEditAttribute(): FileAttribute
    {
        return $this->getPassportUserEdit();
    }

    public function getPassportEditAttribute(): FileAttribute
    {
        return $this->getPassportEdit();
    }
}
