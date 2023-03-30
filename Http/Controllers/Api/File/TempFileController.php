<?php

namespace App\Http\Controllers\Api\File;

use App\Domain\File\Entities\FileManyTemp;
use App\Domain\File\Entities\FileTemp;
use App\Http\Controllers\Api\Base\ApiController;

// file ======  file // or multiple file
// prefix ===== string
class TempFileController extends ApiController
{
    private function upload($className, $files)
    {
        $object = $className::create([]);
        $file = $object->file_create;
        $file->upload($files);
        $prefix = $this->request->prefix;
        return $this->result([
            "file->id_file->$prefix" => $object->id,
            "file->class_name->$prefix" => $className
        ]);
    }

    public function uploadFile(): \Illuminate\Http\JsonResponse
    {
        return $this->upload(FileTemp::class, $this->request->file("file"));
    }

    public function uploadManyFile(): \Illuminate\Http\JsonResponse
    {
        return $this->upload(FileManyTemp::class, $this->request->file('file'));
    }
}
