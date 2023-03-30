<?php

// use query for accessing private lessons
// this means that in player.js file the user will put to the url encoded query
// and send it. In middleware this query will be decoded then permission will be checked
// if it is okay, it will get the file

namespace App\Domain\Core\Media\Services;


use App\Domain\Core\Media\Models\Media;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class MediaServices
{
    public static function createMedia($path, UploadedFile $file, string $key, $id): Media
    {
        $filename = self::generateName($path, $file->getClientOriginalName());
        $file->storeAs($path, $filename);
        return new Media (self::getPathToStore($path, $filename), $key, $id);
    }

    public static function getPathToStore($path, $filename)
    {
        return $path . "/" . $filename;
    }

    private static function generateName(string $storagePath, string $original): string
    {
        $extension = pathinfo($original, PATHINFO_EXTENSION);
        $originalName = str_replace(" ", "", pathinfo($original, PATHINFO_FILENAME));
        $index = null;
        do {
            $filename = sprintf("%s%s.%s", $originalName, $index ?? '', $extension);
            $index = (int)$index + 1;
        } while (Storage::exists(sprintf("%s/%s", $storagePath, $filename)));
        return $filename;
    }
}
