<?php

namespace App\Domain\Core\Front\Admin\OpenButton\Interfaces;

interface FilterInterface
{
    /**
     * for parent entity to be filter according to it
     */
    public function getKeyForFilter();
}
