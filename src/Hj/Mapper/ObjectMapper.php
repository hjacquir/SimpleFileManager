<?php

/**
 * Created by Hatim Jacquir
 * @author : Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj\Mapper;

/**
 * Class Mapper
 * @package Hj\Mapper
 */
abstract class Mapper
{
    /**
     * @var array
     */
    private $array = array();

    /**
     * @param array $array
     */
    public function __construct(Array $array)
    {
        $this->array = $array;
    }

    /**
     * @return Object
     */
    abstract public function mapToObject();
}