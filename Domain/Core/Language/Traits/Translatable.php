<?php


namespace App\Domain\Core\Language\Traits;


use Illuminate\Support\Collection;

trait Translatable
{
    public function getTranslatable(string $key): ?string
    {
        if (($entities = $this->getTranslations($key))->isEmpty())
            return null;
        return $entities[app()->getLocale()] ?? ($entities[config("app.fallback_locale")] ?? $entities->first());
    }

    public function getTransWithLang(string $key, $lang): ?string
    {
        if (($entities = $this->getTranslations($key))->isEmpty())
            return null;
        return $entities[$lang] ?? "";
    }

    private function getTranslations(string $key): ?Collection
    {
        $source = null;
        if (isset($this->original[$key]))
            $source = $this->original[$key];
        if (!isset($source) && isset($this->attributes[$key])) {
            $source = $this->attributes[$key];
        }
        return collect(json_decode($source));
    }

    public function setTranslate(string $key, $value): void
    {
        if ($this->checkIfStringAndEmptyArray($value)) {
            $lang = app()->getLocale();
            $value = [$lang => $value];
        }
        if ($this->isTranslatableValueValid($value)) {
            $this->attributes[$key] = $this->appendToExisting($key, $value);
        }
    }

    public function appendToExisting($key, $value)
    {
        $existing = [];
        if (isset($this->attributes[$key])) {
            $existing = json_decode($this->attributes[$key], true) ?? [];
        }
        return json_encode((object)array_merge($existing, $value), JSON_UNESCAPED_UNICODE);
    }

    private function checkIfStringAndEmptyArray($value): bool
    {
        return is_string($value) && !empty($value);
    }

    private function isTranslatableValueValid($value): bool
    {
        return is_array($value) || $value instanceof Collection;
    }

}
