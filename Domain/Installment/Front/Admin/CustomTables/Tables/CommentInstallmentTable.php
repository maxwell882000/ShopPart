<?php

namespace App\Domain\Installment\Front\Admin\CustomTables\Tables;

use App\Domain\Core\Front\Admin\Attributes\Containers\Container;
use App\Domain\Core\Front\Admin\Attributes\Containers\ContainerRow;
use App\Domain\Core\Front\Admin\Attributes\Containers\ModalContainer;
use App\Domain\Core\Front\Admin\Attributes\Containers\ModalCreator;
use App\Domain\Core\Front\Admin\Attributes\Models\Column;
use App\Domain\Core\Front\Admin\Attributes\Text\Text;
use App\Domain\Core\Front\Admin\Button\ModelInCompelationTime\GrayButtonCompile;
use App\Domain\Core\Front\Admin\Button\ModelInCompelationTime\MainButtonCompile;
use App\Domain\Core\Front\Admin\CustomTable\Abstracts\AbstractDynamicTable;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\TextAreaAttribute;
use App\Domain\Core\Front\Admin\Form\Traits\AttributeGetVariable;
use App\Domain\Installment\Front\Dynamic\CommentInstallmentDynamic;

class CommentInstallmentTable extends AbstractDynamicTable
{
    use AttributeGetVariable;

    public function getInputs(): array
    {
        return $this->generateNewInput(CommentInstallmentDynamic::getCustomRules());
    }

    public static function setInputAttr($key, $type)
    {
        if ($type == self::defer()) {
            return true;
        }

    }

    public function slot(): string
    {
        return ContainerRow::generateClass("items-end justify-end", [
            ModalCreator::new(
                MainButtonCompile::new("Добавить", [
                    '@click' => "open()"
                ]),
                ModalContainer::new([], [
                    Container::new([
                        'class' => "p-5 w-[40vw] space-y-4"
                    ], [
                        Text::new(self::lang("Оставить комментарий"), [
                            'class' => "text-2xl block text-center font-bold"
                        ]),
                        new TextAreaAttribute("", "", true, "reason",
                            [
                                "wire:model.defer" => $this->fillCollectionModel("comment")
                            ]),
                        ContainerRow::new([
                            "class" => 'justify-end'
                        ], [
                            Container::new([
                                'class' => "self-end"
                            ], [
                                GrayButtonCompile::new("Закрыть", [
                                    '@click' => "show = false",
                                ]),
                                MainButtonCompile::new("Добавить", [
                                    "wire:click" => self::ADD_FUNCTION,
                                    '@click' => "show = false",
                                ])
                            ])
                        ]),
                    ])
                ]),
            ),
        ]);
    }

    protected function pathToBlade(): string
    {
        return 'comment.comment_table';
    }

    public function getColumns(): array
    {
        return [
            Column::new(__("Дата создания"), "time_formated-index"),
            Column::new(__("Комментарий"), "comment-index")
        ];
    }
}
