<?php


namespace App\Http\Livewire\Admin\Base\Dropdown\Model;

use App\Domain\Core\Language\Traits\ConvertLanguage;

use App\View\Helper\DropDown\Models\Language\LanguageDropDown;
use App\Domain\Core\Language\Interfaces\LanguageInterface;

abstract class DropDownLangLivewire extends DropDownLivewireComponent
{
    use ConvertLanguage;

    public $drop_lang;

    public function setInitialDropLang()
    {
        $this->drop_lang = LanguageDropDown::getDropDownLivewire();
    }

    public function setDropLang($id, $path)
    {
        $this->drop_lang = $this->getDropDownLivewire($path);
        $this->drop_lang[0]->name = $this->getChosenName($this->drop_lang, $id);
        $lang = app()->getLocale();
        app()->setLocale($this->langToString($id));
        $this->setData();
        app()->setLocale($lang);
    }

    abstract public function setData();
}
