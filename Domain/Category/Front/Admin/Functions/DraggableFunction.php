<?php

namespace App\Domain\Category\Front\Admin\Functions;

use App\Domain\Category\Entities\Category;
use App\Domain\Core\Front\Admin\Livewire\Functions\Abstracts\AbstractFunction;
use Illuminate\Support\Facades\Log;

class DraggableFunction extends AbstractFunction
{
    const FUNCTION_NAME = "reorder";

    // 1  3
    static function reorder($livewire, int $start_id, int $end_id)
    {
//        dd($start_id . ' ' . $end_id);
        $category = Category::find($start_id);
        $temp = $category->order;
        $end_category = Category::find($end_id);
        $category->order = $end_category->order;
        $category->save();
        $end_category->order = $temp;
        $end_category->save();
        Log::info($category->name . ' ' . $end_category->name);
//        if ($start_order > $end_order) {
//            DB::table('categories')->where('order', ">=", $end_order)
//                ->where('order', "<", $start_order)->update([
//                    'order' => DB::raw('"order" + 1')
//                ]);
//        } else {
//            DB::table('categories')->where("order", "<=", $end_order)
//                ->where('order', ">", $start_order)
//                ->update([
//                    'order' => DB::raw('"order" - 1')
//                ]);
//        }
//        $category->order = $end_order;
//        $category->save();
    }
}
