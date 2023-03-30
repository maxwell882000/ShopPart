<?php

namespace App\Domain\Shop\Traits;

trait MediaShopAttributes
{

    public function getMediaPathStorages(): string
    {
        return "shop";
    }

    public function getLogoAttribute($value): \App\Domain\Core\Media\Models\Media
    {
        return $this->getMedia("logo", $value);
    }

    public function setLogoAttribute($value)
    {
        $this->setMedia("logo", $value, $this->id);
    }

    public function setImageInCartAttribute($value)
    {
        $this->setMedia("image_in_cart", $value, $this->id);
    }

    public function getImageInCartAttribute($value)
    {
        return $this->getMedia("image_in_cart", $value);
    }

    public function setImageAttribute($value)
    {
        $this->setMedia("image", $value, $this->id);
    }

    public function getImageAttribute($value): \App\Domain\Core\Media\Models\Media
    {
        return $this->getMedia("image", $value);
    }

    public function getDirectorPassportAttribute($value): \App\Domain\Core\Media\Models\Media
    {
        return $this->getMedia("director_passport", $value);
    }

    public function setDirectorPassportAttribute($value)
    {
        $this->setMedia("director_passport", $value, $this->id);
    }

    public function getLicenceAttribute($value): \App\Domain\Core\Media\Models\Media
    {
        return $this->getMedia("licence", $value);
    }

    public function setLicenceAttribute($value)
    {
        $this->setMedia("licence", $value, $this->id);
    }

    public function getDocumentAttribute($value): \App\Domain\Core\Media\Models\Media
    {
        return $this->getMedia("document", $value);
    }

    public function setDocumentAttribute($value)
    {
        $this->setMedia("document", $value, $this->id);
    }


    public function mediaKeys(): array
    {
        return [
            'logo',
            'image',
            'image_in_cart',
            "director_passport",
            "licence",
            "document",
        ];
    }

}
