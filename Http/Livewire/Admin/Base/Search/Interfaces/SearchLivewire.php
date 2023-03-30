<?php


namespace App\Http\Livewire\Admin\Base\Search\Interfaces;


interface SearchLivewire
{
    public function search(): array;

    public function path(): string;
}
