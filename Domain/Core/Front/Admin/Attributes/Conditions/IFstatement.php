<?php

namespace App\Domain\Core\Front\Admin\Attributes\Conditions;

use App\Domain\Core\Front\Admin\Attributes\Models\EmptyAttribute;
use App\Domain\Core\Front\Interfaces\HtmlInterface;

class IFstatement implements HtmlInterface
{
    private string $condition;
    private HtmlInterface $block;

    private function cleanArrow()
    {
        $len = strlen($this->condition);
        $len_arrow = strlen(\CR::CR);
        $last_length = $len - $len_arrow;
        $check = substr($this->condition, $last_length);
        if ($check == \CR::CR) {
            return substr($this->condition, 0, $last_length);
        }
        return $this->condition;
    }

    public function __construct($condition, $block)
    {
        $this->condition = $condition;
        $this->block = $block;
    }

    static public function new($condition, HtmlInterface $block = null)
    {
        $block = $block ?? EmptyAttribute::new();
        $self = get_called_class();
        return new $self($condition, $block);
    }

    protected function command()
    {
        return "if";
    }

    public function generateHtml(): string
    {
        return sprintf("@%s(%s) %s", $this->command(), $this->cleanArrow(), $this->block->generateHtml());
    }
}
