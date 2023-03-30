<?php

namespace App\Domain\Core\Media\Traits;

use App\Domain\Core\Language\Traits\Translatable;
use App\Domain\Core\Media\Interfaces\MediaInterface;
use App\Domain\Core\Media\Models\Media;
use App\Domain\Core\Media\Services\MediaServices;
use Illuminate\Http\UploadedFile;

trait MediaTraitTranslatable
{
    use Translatable, MediaTrait;

    public function getMedia($key, $value = null, $id = 0): Media
    {
        return new Media($value ?? "", $key, $id);
    }

    final protected function getOriginalValue($key): ?\Illuminate\Support\Collection
    {
        return $this->getTranslations($key);
    }


    public function setMedia($key, $value, $id)
    {
        if (is_array($value) && !empty($value)) {
            foreach ($this->getOriginalValue($key) as $sub_key => $item) { // replace existing
                if ($this->isFileNotExists($value[$sub_key], $item)) {
                    $this->deleteMediaMany($key, $item, $sub_key);
                    $this->storeMediaMany($key, $value[$sub_key], $sub_key, MediaInterface::PUBLIC_PATH, $id);
                    unset($value[$sub_key]);
                }
            }
            foreach ($value as $sub_key => $item) { // insert absolutely new
                $this->storeMediaMany($key, $item, $sub_key, MediaInterface::PUBLIC_PATH, $id);
            }
        }
    }

    public function deleteMediaMany(string $key, $item, $sub_key)
    {
        $media = $this->getMedia($key, $item);
        if ($media->filename) {
            $media->delete();
            $this->setTranslate($key, [$sub_key => ""]);
        }
    }

    public function deleteMedia(string $key, $value)
    {
        foreach ($value as $lang => $item) {
            $media = $this->getMedia($key, $item);
            if ($media->filename) {
                $media->delete();
                $this->setTranslate($key, [$lang => ""]);
            }
        }
    }

    public function storeMediaMany($key, $item, $sub_key, $type, $id)
    {
        if ($item instanceof UploadedFile) {
            $item->extension();
            $this->mediaObject[$key] = MediaServices::createMedia($this->generateBasePath($type), $item, $key, $id);
            $this->setTranslate($key, [$sub_key => $this->mediaObject[$key]->path]);
        } else if (is_string($item)) {
//            dd($item);
            $this->setTranslate($key, [$sub_key => $item]);
        }

    }

    public function storeMedia($key, $value, $type, $id)
    {
        foreach ($value as $lang => $item) {
            if ($item instanceof UploadedFile) {
                $item->extension();
                $this->mediaObject[$key] = MediaServices::createMedia($this->generateBasePath($type), $item, $key, $id);
                $this->setTranslate($key, [$lang => $this->mediaObject[$key]->path]);
            } else if (is_string($value)) {
            }
        }
    }
}
