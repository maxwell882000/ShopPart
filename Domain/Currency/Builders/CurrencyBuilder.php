<?php

namespace App\Domain\Currency\Builders;

use Illuminate\Database\Eloquent\Builder;

class CurrencyBuilder extends Builder
{
   public function last(){
       return $this->orderBy('id', "DESC")->first();
   }
}
