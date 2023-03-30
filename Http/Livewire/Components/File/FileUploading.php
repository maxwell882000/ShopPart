<?php

namespace App\Http\Livewire\Components\File;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class FileUploading extends Component
{
    use \Livewire\WithFileUploads;

    public $fileCustom;
    public $entityId;
    public $uniqueId;
    public string $entityClass;
    public string $mediaKey;
    public bool $multiple;
    public string $label;

    public function mount()
    {
//        dd($this->mediaKey);
        $media = $this->getMedia();
        $this->uniqueId = $media->id;
    }

    public function updatedFileCustom()
    {
        if ($this->fileCustom && $this->fileCustom[0]) {
            $media = $this->getMedia();
            $media->validate($this);
            $media->upload($this->fileCustom);
        }
    }

    public function download($path)
    {

        return Storage::download($path);
    }

    public function delete($id)
    {
        $this->getMedia()->delete($id);
    }


    protected function getMedia()
    {
        $fileAttribute = explode(\CR::CR, $this->mediaKey);
        $firstAccess = $fileAttribute[0];
        unset($fileAttribute[0]);
        $object = $this->entityClass::find($this->entityId)->$firstAccess;
        foreach ($fileAttribute as $item) {
            $object = $object->$item;
//            dd($object);
        }
//        dd($object);
        return $object;
    }

    public function getPath(): string
    {
        return 'livewire.components.file.file-uploading';
    }

    public function render()
    {
        return view(
            $this->getPath(),
            [
                "file_uploaded" => $this->getMedia()->show()
            ]
        );
    }
}
