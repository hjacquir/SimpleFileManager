<?php

/**
 * Created by Hatim Jacquir
 * @author : Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj\Mp3\Elements;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Title
 * @package Hj\Mp3\Elements
 */
class Title extends Element
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $year;

    /**
     * @var ArrayCollection
     */
    private $interpreters;

    public function __construct($identifier, $name, $year)
    {
        parent::__construct($identifier);

        $this->name = $name;
        $this->year = $year;
        $this->interpreters = new ArrayCollection();
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $interpreters
     */
    public function setInterpreters($interpreters)
    {
        $this->interpreters = $interpreters;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getInterpreters()
    {
        return $this->interpreters;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $year
     */
    public function setYear($year)
    {
        $this->year = $year;
    }

    /**
     * @return string
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param Interpreter $interpreter
     */
    public function addInterpreter(Interpreter $interpreter)
    {
        if (false === $this->interpreterAlreadyExist($interpreter)) {
            $this->interpreters->add($interpreter);
        }
    }

    /**
     * @param Interpreter $interpreter
     *
     * @return bool
     */
    private function interpreterAlreadyExist(Interpreter $interpreter)
    {
        return $this->interpreters->contains($interpreter);
    }
}