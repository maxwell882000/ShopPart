<?php

namespace App\Domain\Core\Front\Admin\Attributes\Containers;

use App\Domain\Core\Front\Admin\Attributes\Text\Text;
use App\Domain\Core\Front\Admin\Button\ModelInCompelationTime\GrayButtonCompile;
use App\Domain\Core\Front\Admin\Button\ModelInCompelationTime\MainButtonCompile;
use App\Domain\Core\Front\Admin\Form\Traits\AttributeGetVariable;

class DecisionModal extends ModalContainer
{
    use AttributeGetVariable;

    public array $action;

    public static function new($title = "", $question = "", array $attributes = [], array $action = []): ModalContainer
    {
        return new self($title, $question, $action, $attributes);
    }

    public function __construct(string $title, string $question, array $action = [], array $attributes = [])
    {
        parent::__construct([
            Container::new([
                'class' => 'block p-5 space-y-4',
            ], [
                Text::new(self::lang($title), [
                    'class' => "text-2xl block text-center font-bold"
                ]),
                Text::new(self::lang($question), [
                    'class' => "text-lg  font-medium"
                ]),
                ContainerRow::new([
                    "class" => 'justify-end'
                ], [
                    Container::new([
                        'class' => "self-end"
                    ], [
                        GrayButtonCompile::new("Нет", [
                            '@click' => "show = false"
                        ]),
                        MainButtonCompile::new("Да", self::append([
                            '@click' => "show = false"
                        ], $action))
                    ])
                ]),
            ])
        ], $attributes);
    }
}
