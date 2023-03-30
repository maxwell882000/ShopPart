<?php


namespace App\Domain\Core\Main\Services;


use App\Domain\Core\Language\Traits\ConvertLanguage;

abstract class BaseTranslateService extends BaseService
{
    use ConvertLanguage;

    public function create(array $object_data)
    {
        $locale = app()->getLocale();
        app()->setLocale($this->langToString($object_data['lang']));
        $created = parent::create($object_data);
        app()->setLocale($locale);
        return $created;
    }

    public function update($object, array $object_data)
    {
        $locale = app()->getLocale();
        app()->setLocale($this->langToString($object_data['lang']));
        $created = parent::update($object, $object_data);
        app()->setLocale($locale);
        return $created;
    }
}
