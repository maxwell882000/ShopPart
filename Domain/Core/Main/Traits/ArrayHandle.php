<?php

namespace App\Domain\Core\Main\Traits;

trait ArrayHandle
{

    public function arrayToString(array $data): string
    {
        $str = "\"[";
        $this->concatenate($data, $str);
        return $str . "]\"";
    }

    public function arrayToKeyString(array $data, $operator = ":"): string
    {
        $str = "";
        foreach ($data as $key => $item) {
            $str = $str . sprintf('%s %s %s\n', $key, $operator, $item);
        }
        return $str;
    }


    public function arrayToHTML(array $data): string
    {
        $str = "";
        foreach ($data as $key => $item) {
            $str = $str . sprintf("<b>%s:</b> %s \n", $key, $item);
        }
        return $str;
    }

    private function concatenate(array $data, &$str, $operator = "=>")
    {
        foreach ($data as $key => $item) {
            $str = $str . sprintf('\'%s\' %s %s,', $key, $operator, $item);
        }
    }

    public function arrayToStringWithoutQuotes(array $data): string
    {
        $str = "[";
        foreach ($data as $key => $item) {
            $str = $str . sprintf('"%s" => %s,', $key, $item);
        }
        return $str . "]";
    }
}
