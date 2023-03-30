<?php

namespace App\Domain\Core\Media\Traits;

use App\Domain\Core\Main\Traits\FilterArray;

trait MediaManyTrait
{
    use FilterArray, CheckOnTemp;

    /**
     * @param $parentKey -- method to call child class in the parent class
     * @param $mediaKey -- method of child class to call media
     * @return mixed
     */
    public function getManyMedia($parentKey, $mediaKey)
    {
        $images = $this->$parentKey->map(function ($item) use ($mediaKey) {
            if ($item->$mediaKey->exists())
                return $item->$mediaKey;
            return null;
        })->toArray();
        return self::filterRecursive($images);
    }

    public function setSaveManyMedia(
        $parentKey,
        $inputs,
        $mediaKey
    )
    {
        $previous = $this->$parentKey; // storing previous results
        $this->setManyMedia($inputs, $parentKey, $mediaKey); // creating absolutely new objects
        foreach ($previous as $item) { // deleting previous objects
            $item->cleanMedia(); //  not deleting the real file , because the existing file will be used again
            // and also in the case of mistake
            $item->delete();
        }
    }

    public function setManyMedia($inputs,
                                 $parentKey,
                                 $mediaKey
    )
    {
        foreach ($inputs as $input) {
            $this->$parentKey()->create([$mediaKey => $input]);
        }
    }

}
