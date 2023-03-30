<?php

namespace App\Domain\File\Entities;

use App\Domain\Core\Front\Admin\File\Attributes\FilesAttributes;
use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Media\Traits\MediaManyTrait;
use App\Domain\File\Interfaces\FileTempInterface;
use Illuminate\Http\UploadedFile;

class FileManyTemp extends Entity implements FileTempInterface
{
    use MediaManyTrait;

    protected $table = 'file_many';
//    public $timestamps = true;  remove when re-migrate
    public function files(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(FileTemp::class, "file_id");
    }

    public function setFileNewAttribute(array $value)
    {
        $this->setSaveManyMedia("files", $value, "file");
    }

    public function getFilesMediaAttribute()
    {
        return $this->getManyMedia("files", "file");
    }

    public function getFileUpload()
    {
        return $this->files->map(function ($item) {
            return $item->getFileUpload();
        });
    }

    public function getEmptyFile(): array
    {
        return [new UploadedFile(public_path(".empty"), "")];
    }

    public function getFileCreateAttribute(): FilesAttributes
    {
        return new FilesAttributes(
            $this,
            "files_media",
            $this->id,
            FileTemp::class,
            "file",
            "file_id"
        );
    }
}
