<?php


namespace App\Domain\Core\Front\Admin\Routes\Traits;


trait Routing
{
    public function encodePath(string $path): string
    {
        return str_replace("\\", "%", $path);
    }

    public function decodePath(string $path): string
    {
        return str_replace("%", "\\", $path);
    }
}
