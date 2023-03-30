<?php

namespace App\Domain\Core\Front\Admin\Form\Traits;

use App\Domain\Category\Builders\CategoryBuilder;
use App\Domain\Category\Entities\Category;

/**
 *  TRAIT FOR ATTACHING AND DETACHING NESTED RELATIONSHIP
 *  method attachNested -- for one to many relationship
 *  method attachedManyNested -- for many-to-many relationship
 * */
trait AttachNested
{
    public function attachNested($id, $status, $entityClass, $parent_id, $primary_key = "id")
    {
        if ($status) { // accept
            $entityClass::when(gettype($id) == "array", function ($query) use ($id, $primary_key) {
                return $query->whereIn($primary_key, $id);
            }, function ($query) use ($id, $primary_key) {
                return $query->where($primary_key, '=', $id);
            })->update([
                $parent_id => $this->$primary_key,
            ]);
        } else { // decline
            $entityClass::when(gettype($id) == "array", function ($query) use ($id, $primary_key) {
                return $query->whereIn($primary_key, $id);
            }, function ($query) use ($id, $primary_key) {
                return $query->where($primary_key, '=', $id);
            })->update([
                $parent_id => null,
            ]);
        }
    }
    // takes the array or single id
    // this comes from LivewireNested class
    public function attachedManyNested($id, $key)
    {
        $this->$key()->toggle($id);
    }
}
