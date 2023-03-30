<?php

namespace App\Domain\Core\Front\Admin\File\Interfaces;

interface FileInterface
{
    public function upload($input);

    public function delete($id);

    public function validate($class);

    public function show(): array;
}
