<?php

namespace App\Domain\Core\Main\Traits;

use Symfony\Component\ErrorHandler\Error\FatalError;

trait HasPopKey
{

    public function popConditionMultiple(array  &$array, array $check_keys,
                                         bool   $clean = false,
                                         string $operator = \CR::CR,
                                                $deleteSign = -1): array
    {
        $new_array = $array;
        foreach ($check_keys as $keys) {
            $new_array = $this->popCondition($new_array, $keys, $clean, $operator, $deleteSign);
        }
        return $new_array;
    }

    /**
     * when popCondition used
     * order of inserting nested entities is important
     * namely,
     * given array %f =  [ 's->d->asd' => 'somedata' ]
     * so first $s =  popCondition($f , 's')
     * output $s [ 'd->asd'=> 'somedata']
     * then $d = popCondition($s , 'd')
     * output $d [ 'asd' => "somedata"]
     *
     * clean --- for cleaning null values
     * operator --- means -> sign
     *
     * write the cleaning code before the key
     * wrong keys
     * ->->somedata
     */
    public function popCondition(array  &$array, string $check_key,
                                 bool   $clean = false,
                                 string $operator = \CR::CR,
                                        $deleteSign = -1): array
    {
        try {
            $new_array = [];
            foreach ($array as $key => $value) {
                $key_value = explode($operator, $key);
                /**
                 * we are taking first element
                 * because we are putting key element at the last
                 */
                if (preg_match(sprintf("/^%s$/i", $check_key), $key_value[0])) {
                    unset($key_value[0]);
                    $this->filterPopKey($key_value, $deleteSign);
                    $this->connectPopKey($new_array, $operator, $key_value, $clean, $value);
                    unset($array[$key]);
                }
            }
            return $new_array;
        } catch (FatalError $exception) {

            dd(get_called_class());
        }
    }

    private function connectPopKey(&$new_array, $operator, $key_value, $clean, $value)
    {
        /**
         * we are connecting remained keys
         */
        $connect_rest = implode($operator, $key_value);
        if (!$clean || $value)
            $new_array[$connect_rest] = $value;

    }

    private function filterPopKey(&$key_value, $deleteSign)
    {
        if (isset($key_value[1])) {
            $key_value[1] = preg_replace("/[^\w]/", $deleteSign, $key_value[1]);
            /**
             * filtering the keys
             * there might be cases that by mistake key format will not appropriate
             * instead of check->something will be ->check->something or ->%check->something
             */
            if ($key_value[1] == $deleteSign || $key_value[1] == "") { // if there is nothing after remove the key
                unset($key_value[1]);
            }
        }
    }

}
