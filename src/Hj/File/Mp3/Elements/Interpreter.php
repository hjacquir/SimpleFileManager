<?php

/**
 * Created by Hatim Jacquir
 * @author : Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj\File\Mp3\Elements;

use Hj\Exception\NullArgumentException;

/**
 * Class Interpreter
 * @package Hj\File\Mp3\Elements
 *
 * @todo add unit test
 */
class Interpreter implements Element
{
    const CLASS_NAME = __CLASS__;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var boolean
     */
    private $original;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $firstName;

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

    public function setUniqueId()
    {
        $method = __METHOD__;

        if (null === $this->name) {
            throw new NullArgumentException("You must set the name before calling {$method}");
        }

        if (null === $this->firstName) {
            throw new NullArgumentException("You must set the first name before calling {$method}");
        }

        $this->uniqueId = "{$this->name}_{$this->firstName}";
    }

    /**
     * @return boolean
     */
    public function isOriginal()
    {
        return $this->original;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param boolean $original
     */
    public function setOriginal($original)
    {
        $this->original = $original;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param Element $interpreter
     *
     * @return bool
     */
    public function isEqual(Element $interpreter)
    {
        return $interpreter->getUniqueId() === $this->uniqueId;
    }

    /**
     * @return string
     */
    public function getUniqueId()
    {
        return $this->uniqueId;
    }
}