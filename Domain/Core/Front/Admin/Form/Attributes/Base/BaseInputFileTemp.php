<?php

namespace App\Domain\Core\Front\Admin\Form\Attributes\Base;

use App\Domain\Core\Front\Admin\Form\Traits\AttributeGetVariable;
use App\Domain\Core\Front\Interfaces\HtmlInterface;
use App\Domain\File\Interfaces\FileTempInterface;

abstract class BaseInputFileTemp implements HtmlInterface
{
    use AttributeGetVariable;

    /**
     * @params  $keyToAttach -- when form submit to store to the entity
     * @params  $multiple -- is multiple file submission or not
     * @params  $label -- helper text above the component
     * @params  $class -- FileTemp or FileMany
     * @params  $key   -- specificKey
     * everytime livewire is mounted new temp file will be created
     */
    public string $keyToAttach;
    public string $multiple;
    public string $label;
    public string $class;
    public string $key;
    public bool $create;
    public string $mediaInitialKey;
    public string $wireKey;
    public ?string $customOldValue;

    public function __construct($class,
        $keyToAttach,
        $label,
        $multiple,
                                bool $create = true,
                                string $mediaInitialKey = "",
                                string $wireKey = "",
                                ?string $customOldValue = null
    )
    {
        $this->class = $class;
        $this->key = FileTempInterface::MEDIA_KEY;
        $this->keyToAttach = $keyToAttach;
        $this->multiple = $multiple;
        $this->wireKey = $wireKey;
        $this->label = $label;
        $this->create = $create;
        $this->customOldValue = $customOldValue;
        $this->mediaInitialKey = $mediaInitialKey == "" ? $this->keyToAttach : $mediaInitialKey;
    }

    public static function create($keyToAttach, $label, $wireKey = "", $customOldValue = null)
    {
        $self = get_called_class();
        $object = new $self($keyToAttach, $label);
        $object->wireKey = $wireKey;
        $object->customOldValue = $customOldValue;
        return $object;
    }

    public static function edit($keyToAttach, $label,
                                string $mediaInitialKey = "",
                                string $wireKey = "",
        $customOldValue = null)
    {
        $self = get_called_class();
        $object = new $self($keyToAttach, $label, false, $mediaInitialKey);
        $object->wireKey = $wireKey;
        $object->customOldValue = $customOldValue;
        return $object;
    }
    /// create here the field for initial value
    /// attach it in mount state
    ///
    public function generateHtml(): string
    {
        $attached = 'file->id_file->' . $this->keyToAttach;
        $old = sprintf('old("%s") ?? ""', $attached);
        if ($this->customOldValue) {
            $old = sprintf("old(sprintf(\"%s\", %s)) ?? null", $attached, $this->customOldValue);
            $this->keyToAttach = sprintf($this->keyToAttach, $this->getScope($this->customOldValue));
        }
        return sprintf("<livewire:components.file.file-uploading-without-entity
                    keyToAttach='%s'
                    mediaKey='%s'
                    entityClass='%s'
                    :multiple='%s'
                    :label='__(\"%s\")'
                    :entityId='%s'
                    :mediaInitial='%s ?? \"\"'
                    wire:key='%s'
                     />",
            $this->keyToAttach,
            $this->key,
            $this->class,
            $this->multiple ? 'true' : 'false',
            $this->label,
            $old,
            !$this->create ? $this->getWithoutScopeAtrVariable($this->mediaInitialKey) : "\"\"",
            $this->wireKey
        );
    }
}
