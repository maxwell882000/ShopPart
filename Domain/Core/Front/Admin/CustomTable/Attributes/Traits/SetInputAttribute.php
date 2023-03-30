<?php

namespace App\Domain\Core\Front\Admin\CustomTable\Attributes\Traits;

use App\Domain\Core\Front\Admin\Attributes\Containers\ConcatenateHtml;
use App\Domain\Core\Front\Admin\CustomTable\Attributes\Abstracts\DynamicAttributes;
use App\Domain\Core\Front\Admin\CustomTable\Attributes\Attributes\InputTableAttribute;
use App\Domain\Core\Front\Admin\CustomTable\Attributes\Attributes\TextAttribute;
use App\Domain\Core\Front\Admin\CustomTable\Errors\DynamicTableException;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\TextAreaAttribute;

/**
 * make table dynamic without entity
 * for this I required to put name for the inputs
 * I have to change a litle bit drop down and input
 * so the name will look like or i just need to change table when created ,
 * think just about it
 **/
trait SetInputAttribute
{
    static protected function filter(): int
    {
        return 1;
    }

    static protected function defer(): int
    {
        return 2;
    }

    /*
     * could return true for defer
     * return string for filter
     * */
    public static function setInputAttr($key, $type)
    {
        if ($type == self::defer()) {
            return true;
        }
    }

    protected function generateNewWay(array $rules): array
    {
        $dynamic = $rules;
        $input = [];
        if (empty($dynamic)) {
            throw new DynamicTableException("New way is not supported");
        }
        foreach ($dynamic as $key => $value) {
            $classes = explode("|", $value);
            switch ($classes[0]) {
                case DynamicAttributes::INPUT:
                    $input[$key] = $this->setInputAttributeTable($key, $value);
                    break;
                case DynamicAttributes::DROP_DOWN:
                    $input[$key] = $this->setDropDownAttributeTable($classes[1], $key);
                    break;
                case DynamicAttributes::TEXT_AREA:
                    $input[$key] = $this->setTextAreaAttributeTable($key);
                    break;
                case DynamicAttributes::NOTHING:
                    $input[$key] = "";
                    break;
                default:
                    $input[$key] = TextAttribute::generation($this, $key);
            }
            if ($classes[0] == DynamicAttributes::INPUT) {

            } else if ($classes[0] == DynamicAttributes::DROP_DOWN) {

            }
        }
        return $input;
    }


    protected function generateOldWay(array $rules): array
    {
        $input = [];
        foreach ($rules as $key => $value) {
            $input[$key] = $this->setInputAttributeTable($key, $value);
        }
        return $input;
    }

    private function setTextAreaAttributeTable($key)
    {
        return ConcatenateHtml::new([
            new TextAreaAttribute(
                "comment",
                "",
                true,
                "",
                [
                    'wire:model.differ' => $this->fillCollectionModel($key)
                ]
            )
        ])->render();
    }

//   abstract private function abstractCreationKey():string;
    private function setInputAttributeTable($key, $value, $unique_key = ""): string
    {
        $is_number = false;
        foreach (explode("|", $value) as $item) {
            if ($item == "numeric") {
                $is_number = true;
                break;
            }
        }
        return InputTableAttribute::generate(
            $this->fillCollectionModel($key),
            $is_number ? "number" : "text",
            $this->fillCollectionModel($key),
            $this->setInputAttr($key, self::defer()),
            $this->setInputAttr($key, self::filter()),
            $unique_key
        );
    }


    protected function fillCollectionModel($key = ""): string
    {
        return 'collection.' . $this->id . '.' . $key;
    }

    /**
     * $key most be empty for drop down because it is handeled internally
     */
    private function setDropDownAttributeTable($class, $key)
    {
        return $class::generate(
            $this->fillCollectionModel(),
            $this->$key ?? null
        );
    }
}
