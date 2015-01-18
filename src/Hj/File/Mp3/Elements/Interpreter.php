<?php

/**
 * Created by Hatim Jacquir
 * @author : Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj\File\Mp3\Elements;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Interpreter
 * @package Hj\File\Mp3\Elements
 *
 * @todo add unit test
 */
class Interpreter
{
    const CLASS_NAME = __CLASS__;

    /**
     * @var integer
     */
    private $identifier;

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
     * @var ArrayCollection
     */
    private $titles;

    public function __construct()
    {
        $this->titles = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getIdentifier()
    {
        return $this->identifier;
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
     * @param int $identifier
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;
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
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param Title $title
     */
    public function addTitle(Title $title)
    {
        if (false === $this->titleAlreadyExist($title)) {
            $this->titles->add($title);
        }
    }

    /**
     * @param Title $title
     *
     * @return bool
     */
    private function titleAlreadyExist(Title $title)
    {
        return $this->titles->contains($title);
    }
}