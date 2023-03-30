<?php

namespace App\Domain\File\Interfaces;

interface FileTempInterface
{
    const MEDIA_KEY = "file_create";

    public function getFileUpload();

     public function getFileCreateAttribute();
}
