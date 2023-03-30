<?php

namespace App\Domain\File\Traits;

// create two methods one for empty file
// other for exception throwing
trait FileUploadService
{
    /**
     * <input name="file-id_file-{{$keyToAttach}}" value="{{$entityId}}">
     * <input name="file-class_name-{{$keyToAttach}}" value="{{$entityClass}}">
     */
    public function serializeTempFile(array &$objectData, bool $raise_exception = false)
    {
        $file_class = $this->popCondition($objectData, "file");
        $file_id = $this->popCondition($file_class, "id_file");
        foreach ($file_id as $key => $value) {
            // decides to use FileTemp or FileManyTemp
            $tempClass = $file_class['class_name' . \CR::CR . $key];
            $object = $tempClass::find($value);
            try {
                $objectData[$key] = $object->getFileUpload();
            } catch (\Exception $exception) {
                if ($raise_exception) {
                    throw  new \Exception(__("Загрузка файлов обязательна"));
                } else {
                    $objectData[$key] = "";
                }
            }
        }
    }
}
