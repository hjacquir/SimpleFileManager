<?php

/**
 * Created by Hatim Jacquir
 * @author : Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj\File\Mp3\Elements;

use Hj\Exception\NullArgumentException;

/**
 * Class Title
 * @package Hj\File\Mp3\Elements
 */
class Title implements Element
{
    const CLASS_NAME = __CLASS__;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var integer
     */
    private $year = null;

    /**
     * @var Interpreter
     */
    private $interpreter;

    /**
     * @var string
     */
    private $uniqueId;

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param Interpreter $interpreter
     */
    public function setInterpreter(Interpreter $interpreter)
    {
        $this->interpreter = $interpreter;
    }

    /**
     * @return Interpreter
     */
    public function getInterpreter()
    {
        return $this->interpreter;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param string $year
     */
    public function setYear($year)
    {
        $this->year = $year;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function setUniqueId()
    {
        $method = __METHOD__;

        if (null === $this->name) {
            throw new NullArgumentException("You must set the name before calling {$method}");
        }

        if (null === $this->interpreter) {
            throw new NullArgumentException("You must set the interpreter before calling {$method}");
        }

        $this->uniqueId = "{$this->name}_{$this->interpreter->getUniqueId()}";
    }

    /**
     * @param Element $title
     *
     * @return bool
     */
    public function isEqual(Element $title)
    {
        return $this->uniqueId === $title->getUniqueId();
    }

    /**
     * @return string
     */
    public function getUniqueId()
    {
        return $this->uniqueId;
    }
}