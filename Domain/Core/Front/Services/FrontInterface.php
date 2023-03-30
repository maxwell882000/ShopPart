<?php

namespace App\Domain\Core\Front\Services;

// AttributesInterface where will be stored all types
// ColumnInterface where will be stored all column types
// rows
//Livewire component

interface FrontInterface
{


    static public function getTitles(): array;
    // table

    // column_name => row_name
    // will be in new entity

    // there will be passed filter class by it will be decided which livewire create
    static public function getFilter(): array;

    // Search Component , Filter Component
    public function livewireComponents(): array;

}

/// must create templates for livewire
/// analyze what components are required make the table
/// || date , drop down search, check box, plus and will be created one more input where language already known
/// || open close livewire may be called , there we will enter filtration
///
/// already done components input , drop down , open button,
///
///
///
///
/// way of archive the user and the product if it is needed
///
