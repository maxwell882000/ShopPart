<?php

namespace App\Domain\Core\File\Abstracts;

use App\Domain\Core\File\Interfaces\BladeCreatorInterface;
use App\Domain\Core\Front\Admin\Form\Traits\AttributeGetVariable;
use App\Domain\Core\Front\Admin\Templates\Models\BladeGenerator;

/// addTitle can be done
abstract class  AbstractFileManagerBlade extends AbstractFileManager implements BladeCreatorInterface
{
    use AttributeGetVariable;

    protected BladeGenerator $bladeGenerator;
    protected $entity;

    public function __construct($className, BladeGenerator $bladeGenerator, $entity)
    {
        $this->bladeGenerator = $bladeGenerator;
        $this->classNameBlade = $this->toSnackCase($className);
        $this->entity = $entity;
        $this->setMainPath();
        $this->createFolderIfExists();
        $this->openFile();
    }

    protected function setMainPath()
    {
        $this->pathMain = static::TO . $this->putInDirectory() . "/" . $this->classNameBlade . "/";
    }

    protected function putInDirectory()
    {
        return "admin";
    }

    public function openFile()
    {
        $index = $this->getPath();
        $file_from = $this->getContents($this->getTemplatePath());
        $formatted_index = $this->formatFile($file_from);
        $this->putContents($index, $this->putFormattedBlade($formatted_index));
    }


    protected function getTitle()
    {
        try {
            return $this->translate($this->entity->getTitle()) . " " . $this->getScope($this->entity->addTitle());
        } catch (\Exception $exception) {
            try {
                return $this->translate($this->entity->getTitle());
            } catch (\Exception $exception) {
                try {
                    return $this->entity->getVarTitle();
                } catch (\Exception $exception) {
                    return null;
                }
                return "";
            }
        }
    }

    protected function translate($value)
    {
        return $this->getScope(sprintf('__("%s")', $value));
    }

    protected function formatFile($file_from): string
    {
        return sprintf($file_from,
            $this->getTitle(),
            $this->bladeGenerator->generateHtml(),
        );
    }

    protected function putFormattedBlade($formatted_blade)
    {
        $formatted_blade = $formatted_blade . $this->header();
        if ($this->isWithSideBar()) {
            return $formatted_blade . $this->sideBar();
        }
        return $formatted_blade;
    }

    protected function isWithSideBar(): bool
    {
        return true;
    }

    private function header()
    {
        return sprintf('@section("new_header")
                <x-helper.header.%s/>
            @endsection', $this->headerName());
    }

    protected function headerName()
    {
        return "header";
    }

    private function sideBar()
    {
        return sprintf('
@section("sidebar")
    <div class="">
        <x-helper.sidebar.new_sidebar name="Админ" :list="%s::sideBars()"/>
    </div>
@endsection
', $this->sideBarName());
    }

    protected function sideBarName(): string
    {
        return "\SideBar";
    }

    abstract protected function getPath(): string;

    abstract protected function getTemplatePath(): string;

}
