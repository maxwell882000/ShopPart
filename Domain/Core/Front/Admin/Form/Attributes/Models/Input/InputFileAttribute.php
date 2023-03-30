<?php

namespace App\Domain\Core\Front\Admin\Form\Attributes\Models\Input;

use App\Domain\Core\Front\Admin\Form\Attributes\Base\BaseAttributeForm;

// make livewire
// make one more button to add and continue
// make search and dropdown | search will appear if the some icon was pressed
// input label must do
class InputFileAttribute extends BaseAttributeForm
{
    public string $class;
    public bool $multiple;
    public string $id;

    /**
     * $key -- the key to access file attribute
     * $label -- helper text
     * $class -- class of entity which is accessed self::class
     * $multiple -- multiple file upload or not
     */
    public function __construct(string $key,
                                string $label,
                                string $class,
                                string $id = 'id',
                                bool   $multiple = false)
    {
        parent::__construct($key, $label);
        $this->class = $class;
        $this->id = $id;
        $this->multiple = $multiple;
    }

    public function generateHtml(): string
    {
        return sprintf("<livewire:components.file.file-uploading
                    :entityId='%s'
                    mediaKey='%s'
                    entityClass='%s'
                    :multiple='%s'
                    label='%s'
                     />",
            $this->getWithoutScopeAtrVariable('id'),
            $this->key,
            $this->class,
            $this->multiple ? "true" : 'false',
            $this->label
        );
    }
}
