<?php

/**
 * Created by Hatim Jacquir
 * @author : Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj\Transformer;

/**
 * Class ArrayTransformer
 * @package Hj\Transformer
 */
class ArrayTransformer
{
    /**
     * @param array $array
     * @param boolean $upperCaseFirst
     *
     * @return array
     */
    public static function camelCaseKey(Array $array, $upperCaseFirst = false)
    {
        foreach ($array as $key => $value) {
            $newValue = StringTransformer::camelCase($value, $upperCaseFirst);

            $array[$key] = $newValue;
        }

        return $array;
    }

    /**
     * @param array $keys
     * @param array $values
     *
     * @return array
     */
    public static function convertToAssociativeArray(Array $keys, Array $values)
    {
        return array_combine($keys, $values);
    }
}