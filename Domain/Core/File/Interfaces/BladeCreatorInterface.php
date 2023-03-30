<?php

namespace App\Domain\Core\File\Interfaces;

interface BladeCreatorInterface
{
    const BASE = "resources/views/admin/";
    const FROM = self::BASE . "template/base/";
    const FROM_OPEN = self::BASE . "template/open_base/";

    const TO = self::BASE . "pages/";

    const INDEX = "index.blade.php";
    const CREATE = "create.blade.php";
    const CREATE_NEXT = "create_next.blade.php";
    const EDIT = "edit.blade.php";
    const CHOOSE = "choose.blade.php";
    const SHOW = "show.blade.php";

    /**
     * @params  first  --- Title
     *          second --- Livewire
     */
    const FROM_INDEX = self::FROM . self::INDEX; // include livewire
    const FROM_EDIT = self::FROM . self::EDIT;
    const FROM_CREATE = self::FROM . self::CREATE;
    const FROM_CREATE_NEXT = self::FROM . self::CREATE_NEXT;
    const FROM_CHOOSE = self::FROM . self::CHOOSE;
    const FROM_SHOW = self::FROM . self::SHOW;

    const FROM_INDEX_OPEN = self::FROM_OPEN . self::INDEX; // include livewire
    const FROM_EDIT_OPEN = self::FROM_OPEN . self::EDIT;
    const FROM_CREATE_OPEN = self::FROM_OPEN . self::CREATE;
    const FROM_CHOOSE_OPEN = self::FROM_OPEN . self::CHOOSE;

    public function openFile();

}
