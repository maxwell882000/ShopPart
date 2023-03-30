<?php

namespace App\Domain\Core\Text\Traits;

trait CaseConverter
{
    protected function toSnackCase($name): string
    {
        $ret = $this->prepareConvertCase($name);
        return implode('_', $ret);
    }

    private function prepareConvertCase($name)
    {
        preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $name, $matches);
        $ret = $matches[0];
        foreach ($ret as &$match) {
            $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
        }
        return $ret;
    }

    public function toLivewireCase($name): string
    {
        $ret = $this->prepareConvertCase($name);
        return implode('-', $ret);
    }
    function toCamelCase($string, $capitalizeFirstCharacter = false)
    {

        $str = str_replace(' ', '', ucwords(str_replace('_', ' ', $string)));

        if (!$capitalizeFirstCharacter) {
            $str[0] = strtolower($str[0]);
        }

        return $str;
    }

}
