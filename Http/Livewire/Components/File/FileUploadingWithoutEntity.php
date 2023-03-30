<?php

namespace App\Http\Livewire\Components\File;

class FileUploadingWithoutEntity extends FileUploading
{
    public string $keyToAttach;


    public function mount($mediaInitial = null)
    {
        $this->createObject($mediaInitial);
        parent::mount();
    }

    private function createObject($mediaInitial = null)
    {
        if (!$this->entityId) {
            $entity = $this->entityClass::create([]);
            if ($mediaInitial) {
                $entity->file_new = $mediaInitial;
                $entity->save();
            }
            $this->entityId = $entity->id;
        }

    }


    public function getPath(): string
    {
        return 'livewire.components.file.file-uploading-without-entity';
    }
}
