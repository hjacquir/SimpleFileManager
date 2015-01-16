<?php

/**
 * Created by Hatim Jacquir
 * @author : Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj\Mp3\Elements;

/**
 * Class Interpreter
 * @package Hj\Mp3\Elements
 */
class Interpreter extends Element
{
    /**
     * @var boolean
     */
    private $isOriginal;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @param integer $identifier
     * @param string $name
     * @param string $lastName
     */
    public function __construct($identifier, $name, $lastName)
    {
        parent::__construct($identifier);

        $this->name = $name;
        $this->lastName = $lastName;
        $this->isOriginal = false;
    }
}