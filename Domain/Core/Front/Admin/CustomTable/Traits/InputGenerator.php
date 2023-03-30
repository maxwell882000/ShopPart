<?php

namespace App\Domain\Core\Front\Admin\CustomTable\Traits;

use App\Domain\Core\Front\Admin\CustomTable\Attributes\Attributes\InputTableAttribute;
use App\Domain\Core\Front\Admin\CustomTable\Attributes\Traits\SetInputAttribute;
use App\Domain\Core\Front\Admin\CustomTable\Errors\DynamicTableException;

trait InputGenerator
{
    use SetInputAttribute;

    private string $model = "";

    protected function generateInput(array $rules, string $model = 'entity.'): array
    {
        $this->model = $model;
        return $this->generateOldWay($rules);
    }

    protected function generateNewInput(array $rules, string $model = 'entity.'): array
    {
        $this->model = $model;
        return $this->generateNewWay($rules);
    }

    protected function fillCollectionModel($key = ""): string
    {
        return $this->model . $key;
    }
}
// old way of doing this. Stored for the cased
//$is_numeric = false;
//
//foreach (explode("|", $rule) as $item) {
//    if ($item == "numeric") {
//        $is_numeric = true;
//        break;
//    }
//}
//
//$inputs[$key] = InputTableAttribute::generate(
//    $key,
//    !$is_numeric ? "text" : "number",
//    $model . $key,
//
//    $this->setInputAttr($key, self::defer()),
//    $this->setInputAttr($key, self::filter()),
//    "input_table_" . $key,
//);
