<?php


namespace App\Domain\Core\Main\Entities;


//create several types

// header will be livewire for asynchornious
use App\Domain\Core\Main\Interfaces\RuleInterface;
use Illuminate\Database\Eloquent\Model;

class Entity extends Model implements RuleInterface
{
    public $timestamps = false;
    protected $guarded = ['params'];


    public function getClassNameAttribute(): string
    {
        $array = explode("\\", get_class($this));
        return end($array);
    }

    static public function new()
    {

        return new static();
    }


    static public function getRules(): array
    {
        return [];
    }

    static public function getUpdateRules(): array
    {
        return [];
    }

    static public function getValidationMessage(): array
    {
        return [];
    }

    static public function getCreateRules(): array
    {
        return self::getRules();
    }
}

