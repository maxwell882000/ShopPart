<?php

namespace App\Domain\File\Entities;

use App\Domain\Core\Front\Admin\File\Attributes\FileAttribute;
use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Media\Traits\MediaTrait;
use App\Domain\File\Interfaces\FileTempInterface;
use Illuminate\Http\UploadedFile;

class FileTemp extends Entity implements FileTempInterface
{
    use MediaTrait;

    protected $table = "files";

//    public $timestamps = true;  remove when re-migrate

    public function getFileAttribute($value): \App\Domain\Core\Media\Models\Media
    {
        return $this->getMedia('file', $value, $this->id);
    }

    public function setFileAttribute($value)
    {
        $this->setMedia('file', $value, $this->id);
    }

    public function setFileNewAttribute($value)
    {
        $this->file = $value;
    }

    public function getMediaPathStorages(): string
    {
        return "temp/files";
    }

    public function mediaKeys(): array
    {
        return [
            'file'
        ];
    }

    public function getFileUpload(): UploadedFile
    {
        return new UploadedFile(public_path($this->file->storage()), $this->file->filename);
    }

    public function getEmptyFile(): UploadedFile
    {
        return new UploadedFile(public_path(".empty"), "");
    }

    // this will be gotted
    public function getFileCreateAttribute(): FileAttribute
    {
        return new FileAttribute(
            $this,
            "file",
            $this->id,
        );
    }
}
