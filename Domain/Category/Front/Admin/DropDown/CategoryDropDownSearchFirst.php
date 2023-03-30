<?php

namespace App\Domain\Category\Front\Admin\DropDown;

class CategoryDropDownSearchFirst extends CategoryDropDownSearch
{

    static protected function applyFilter(&$filterBy)
    {
        $filterBy['not_in_category_in_home'] = true;
    }
}
