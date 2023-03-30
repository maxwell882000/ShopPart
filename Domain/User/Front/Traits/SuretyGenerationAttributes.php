<?php

namespace App\Domain\User\Front\Traits;

use App\Domain\Core\Front\Admin\Attributes\Conditions\ELSEstatement;
use App\Domain\Core\Front\Admin\Attributes\Conditions\ENDIFstatement;
use App\Domain\Core\Front\Admin\Attributes\Conditions\IFstatement;
use App\Domain\Core\Front\Admin\Attributes\Containers\ConcatenateHtml;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\Input\InputAttribute;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\Input\InputFileAttribute;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\Input\InputFileTempAttribute;
use App\Domain\Core\Front\Admin\Form\Traits\AttributeGetVariable;
use App\Domain\Core\Front\Admin\Templates\Models\BladeGenerator;
use App\Domain\User\Front\Dynamic\SuretyPlasticCardDynamic;
use App\Domain\User\Front\Open\SuretyOpenEdit;
use App\Domain\User\Interfaces\SuretyRelationInterface;
use App\Domain\User\Traits\HasCrucialFilesTrait;

trait SuretyGenerationAttributes
{
    use AttributeGetVariable, HasCrucialFilesTrait;

    static public function generationSuretyEdit(string $relation = "", string $class = SuretyOpenEdit::class): BladeGenerator
    {
        return BladeGenerator::generation([
            new InputAttribute($relation . "phone", "text", "Телефон пользователя", false),
            new InputAttribute(
                $relation . 'additional_phone',
                "text",
                "Дополнительный телефон", false),
            new InputAttribute(
                $relation . SuretyRelationInterface::CRUCIAL_DATA
                . "firstname",
                "text", "Имя пользователя", false),
            new InputAttribute(
                $relation . SuretyRelationInterface::CRUCIAL_DATA
                . "lastname",
                "text", "Фамилия пользователя", false),
            new InputAttribute(
                $relation . SuretyRelationInterface::CRUCIAL_DATA
                . "father_name",
                "text", "Отчество пользователя", false),
            new InputAttribute(
                $relation . SuretyRelationInterface::CRUCIAL_DATA
                . 'series',
                "text", "Паспорт серия", false),
            new InputAttribute(
                $relation . SuretyRelationInterface::CRUCIAL_DATA
                . 'pnfl',
                "text", "ПНФЛ", false),
            new InputAttribute(
                $relation . SuretyRelationInterface::CRUCIAL_DATA
                . 'date_of_birth',
                "date", "Дата рождения",
                false),
            IFstatement::new(self::getWithoutScopeAtrVariable($relation),
                ConcatenateHtml::new(self::generateEditFiles($relation, $class))),
            ELSEstatement::new(
                ConcatenateHtml::new(self::generateCreateFile($relation))),
            ENDIFstatement::new()
        ]);
    }

    static private function generateEditFiles($relation, $class)
    {
        return [
            new InputFileAttribute(
                $relation . SuretyRelationInterface::CRUCIAL_DATA . "passport_reverse_edit",
                "Прописка",
                $class),
            new InputFileAttribute(
                $relation . SuretyRelationInterface::CRUCIAL_DATA . "passport_user_edit",
                "Паспорт c пользователем",
                $class),
            new InputFileAttribute(
                $relation . SuretyRelationInterface::CRUCIAL_DATA . 'passport_edit',
                "Паспорт пользователя",
                $class),
            static::getPlastic()
        ];
    }

    static protected function getPlastic($className = 'SuretyOpenEdit')
    {
        return SuretyPlasticCardDynamic::getDynamic($className);

    }

    static private function generateCreateFile(string $relation)
    {
        return [
            new InputFileTempAttribute(
                $relation . SuretyRelationInterface::CRUCIAL_DATA
                . "passport_reverse",
                "Прописка"),
            new InputFileTempAttribute(
                $relation . SuretyRelationInterface::CRUCIAL_DATA
                . "user_passport",
                "Паспорт c пользователем"),
            new InputFileTempAttribute(
                $relation . SuretyRelationInterface::CRUCIAL_DATA
                . 'passport',
                "Паспорт пользователя"),
        ];
    }

    static public function generationSuretyCreate(string $relation = ""): BladeGenerator
    {
        return BladeGenerator::generation([
            new InputAttribute(
                $relation . "phone",
                "text",
                "Телефон пользователя"),
            new InputAttribute(
                $relation . 'additional_phone',
                "text",
                "Дополнительный телефон"),
            new InputAttribute(
                $relation . SuretyRelationInterface::CRUCIAL_DATA
                . "firstname",
                "text", "Имя пользователя"),
            new InputAttribute(
                $relation . SuretyRelationInterface::CRUCIAL_DATA
                . "lastname",
                "text", "Фамилия пользователя"),
            new InputAttribute(
                $relation . SuretyRelationInterface::CRUCIAL_DATA
                . "father_name",
                "text", "Отчество пользователя"),
            new InputAttribute(
                $relation . SuretyRelationInterface::CRUCIAL_DATA
                . 'series',
                "text", "Паспорт серия"),
            new InputAttribute(
                $relation . SuretyRelationInterface::CRUCIAL_DATA
                . 'pnfl',
                "text", "ПНФЛ"),
            new InputAttribute(
                $relation . SuretyRelationInterface::CRUCIAL_DATA
                . 'date_of_birth',
                "date", "Дата рождения"),
            ...self::generateCreateFile($relation)
        ]);
    }


}
