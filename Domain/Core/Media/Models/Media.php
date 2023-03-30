<?php


namespace App\Domain\Core\Media\Models;
// store the file
// save the path

use App\Domain\Core\Media\Interfaces\MediaInterface;
use Illuminate\Support\Facades\Storage;

/// this class are needed
///  because we will get the object with help of we can manipulate actual file
/// not just string
class Media implements MediaInterface
{
    private $path;
    public $key;
    public $id;

    public function __construct($path, $key, $id)
    {
        $this->path = $path;
        $this->key = $key;
        $this->id = $id;
    }

    private function getFileName(): ?string
    {
        if (pathinfo($this->path, PATHINFO_EXTENSION) == "empty") {
            return null;
        }
        return pathinfo($this->path, PATHINFO_BASENAME);
    }

    public function getFilePath()
    {
        return $this->path;
    }

    public function exists()
    {
        return isset($this->path) && Storage::disk()->exists($this->path);
    }

    public function delete(): bool
    {

        if (isset($this->path)) {
            return Storage::delete($this->path) && !($this->path = "");

        }
        return false;
    }

    public function storage(): string
    {
        return Storage::url($this->path);
    }

    public function fullPath()
    {
        if (Storage::exists($this->path))
            return url($this->storage());
        return "";
    }

    public function download()
    {
        return Storage::download($this->path);
    }


    public function __get(string $name)
    {
        switch ($name) {
            case "filename":
                return $this->getFileName();
            case "path":
                return $this->getFilePath();
        }
        return null;
    }
}
