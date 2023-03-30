<?php

namespace App\Domain\Core\Front\Admin\Form\Interfaces;

use App\Domain\Core\Front\Admin\Templates\Models\BladeGenerator;

interface CreateAttributesInterface
{
    public function generateAttributes(): BladeGenerator;
}

