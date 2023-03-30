<?php

namespace App\Domain\Core\Main\Traits;

use Illuminate\Support\Facades\Log;

trait FilterArray
{
    static public function filterRecursive(array $data, callable $filter = null): array
    {
        return array_filter($data, function ($item) use ($filter) {
            $item = is_array($item) ? self::filterRecursive($item, $filter) : $item;
            return isset($filter) ? $filter($item) : isset($item) && (!empty($item) || $item == "0" || $item == 0);
        });
    }
}
