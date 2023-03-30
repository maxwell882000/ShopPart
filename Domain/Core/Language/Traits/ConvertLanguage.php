<?php


namespace App\Domain\Core\Language\Traits;


use App\Domain\Core\Language\Interfaces\LanguageInterface;

trait ConvertLanguage
{
    public function langToString($lang)
    {
        switch ($lang) {
            case LanguageInterface::RUSSIAN:
                return "ru";
            case LanguageInterface::UZBEK:
                return "uz";
            case  LanguageInterface::ENGLISH:
                return "en";
            default:
                return app()->getLocale();
        }
    }
}
