<?php


namespace App\Domain\Core\Front\Admin\Routes\Interfaces;


interface RoutesInterface
{
    public const INDEX_ROUTE = "change.index";
    public const CREATE_ROUTE = "change.create";
    public const EDIT_ROUTE = "change.edit";
    public const DESTROY_ROUTE = "change.destroy";
    public const STORE_ROUTE = "change.store";
    public const UPDATE_ROUTE = "change.update";
    public const SHOW_ROUTE = "change.show";
    public const  INDEX = 'index';
    public const  CREATE = 'create';
    public const  EDIT = 'edit';
    public const SHOW = 'show';
}

