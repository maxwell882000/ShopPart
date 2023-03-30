<?php

namespace App\Domain\Core\Front\Admin\File\Attributes;

use App\Domain\Core\Front\Admin\File\Base\BaseFileAttribute;
use App\Domain\Core\Front\Admin\File\Interfaces\FileInterface;
use App\Domain\Core\Media\Models\Media;

class FileAttribute extends BaseFileAttribute
{

    public function upload($input)
    {
        $key = $this->key;
        if (gettype($input) == "array") {
            $this->entity->$key = $input[0];
        } else {
            $this->entity->$key = $input;
        }
        $this->entity->save();
    }


    public function delete($id)
    {
        $key = $this->key;
        $this->entity->$key->delete();
        $this->entity->save();
    }

    public function validate($class)
    {
        // TODO: Implement validate() method.
    }

    public function show(): array
    {
//        dd($this->entity);
        $key = $this->key;
        return [$this->entity->$key];
    }
}
