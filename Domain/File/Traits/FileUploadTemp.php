<?php

namespace App\Domain\File\Traits;

use App\Domain\Core\Front\Admin\File\Attributes\FileAttribute;
use App\Domain\Core\Front\Admin\File\Attributes\FilesAttributes;
use App\Domain\File\Entities\FileManyTemp;
use App\Domain\File\Entities\FileTemp;
//**
// this trait not necesarry at all
//*/
trait FileUploadTemp
{
    public function getFilesCreateTempAttribute(): FilesAttributes
    {
        $file = FileManyTemp::create([]);
        return new FilesAttributes(
            $file,
            "files",
            $file->id,
            FileTemp::class,
            "file",
            "file_id"
        );
    }

    private static function getFilesTempName(): string
    {
        return "files_create_temp";
    }

    private static function getFileTempName(): string
    {
        return 'file_create_temp';
    }

    public function getFileCreateTempAttribute(): FileAttribute
    {
        $file = FileTemp::create([]);
        return new FileAttribute(
            $file,
            "file",
            $file->id,
        );
    }
}
