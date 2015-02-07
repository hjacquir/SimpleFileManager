<?php

/**
 * Created by Hatim Jacquir
 * @author : Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj\Mapper;

/**
 * Map an array to an object
 *
 * Class ObjectMapper
 * @package Hj\Mapper
 */
abstract class ObjectMapper
{
    /**
     * @var array
     */
    private $array = array();

    /**
     * @return array
     */
    public function getArray()
    {
        return $this->array;
    }

    /**
     * @param array $array
     */
    public function setArray(Array $array)
    {
        $this->array = $array;
    }

    abstract protected function map();
}