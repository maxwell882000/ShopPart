<?php

namespace App\Domain\Core\File\Traits;

use Illuminate\Support\Facades\Log;

trait FileManager
{
    //I will extend my controller the controller will get all necessary data
    //Then I will create the blade with all fields required
    //And It will work
    //Add some custom livewire to product
    // file_get_contents
    // file_put_contents
    public function createFile($path, $path_to_write)
    {
        $real_path = $this->convertToPath($path);
        if ($this->checkFileExistence($real_path)) {
            return;
        }
        if (!$this->checkFolderExistence($real_path)) {
            $this->createDirectory($real_path);
        }
    }

    private function checkFileExistence($path): bool
    {
        return file_exists($path);
    }

    private function convertToPath($path)
    {
        return str_replace(".", "/", $path);
    }

    private function checkFolderExistence($path): bool
    {
        $folder = explode("/", $path);
        array_pop($folder);

        return $this->checkFileExistence($folder);
    }

    public function createDirectory($path)
    {
        try {
            mkdir($path, 0777 , true);
        } catch (\Exception $exception) {

        }

    }


}

