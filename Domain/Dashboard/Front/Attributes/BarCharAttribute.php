<?php

namespace App\Domain\Dashboard\Front\Attributes;

use App\Domain\Core\Front\Admin\Attributes\Models\EmptyAttribute;

class BarCharAttribute extends EmptyAttribute
{
    public function generateHtml(): string
    {
        return "<x-dashboard.bar_chart  />";
    }
}
