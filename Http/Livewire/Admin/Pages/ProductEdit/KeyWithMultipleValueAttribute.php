<?php

namespace App\Http\Livewire\Admin\Pages\ProductEdit;  // 1  --- namespace
use App\Http\Livewire\Admin\Base\Abstracts\BaseLivewireFactoring;

class KeyWithMultipleValueAttribute extends BaseLivewireFactoring
{
        
 public $listeners = [ 'fromCategory' => 'fromCategory']; public function fromCategory(){return \App\Domain\Product\Product\Front\Admin\Functions\FromCategory::fromCategory($this,...func_get_args());}public function fillObjects(){return \App\Domain\Product\Product\Front\Admin\Functions\FromCategory::fillObjects($this,...func_get_args());}public function render(){return \App\Domain\Product\Product\Front\Admin\Functions\FromCategory::render($this,...func_get_args());} public $fileCustom; use \Livewire\WithFileUploads; public function updatedFileCustom(){return \App\Domain\Product\Product\Front\Admin\Functions\KeyWithMultipleValueExcel::updatedFileCustom($this,...func_get_args());}


    function getPath()
    {
        return 'livewire.admin.pages.product-edit.key-with-multiple-value-attribute';
    }

}
