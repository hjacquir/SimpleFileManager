<?php

/**
 * Created by Hatim Jacquir
 * @author : Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj\Collection;

use Hj\File\Mp3\Elements\Element;
use Hj\File\Mp3\Elements\Interpreter;
use Hj\File\Mp3\Elements\Title;

/**
 * Class ElementCollection
 * @package Hj\Collection
 */
class ElementCollection
{
    /**
     * @var Element[]
     */
    private $elements = array();

    /**
     * @param Element $element
     */
    public function add(Element $element)
    {
        if (false === $this->alreadyExist($element)) {
            $this->elements[] = $element;
        }
    }

    /**
     * @return array
     */
    public function getInterpreters()
    {
        return $this->getElementByClassName(Interpreter::CLASS_NAME);
    }

    /**
     * @return array
     */
    public function getTitles()
    {
        return $this->getElementByClassName(Title::CLASS_NAME);
    }

    /**
     * @return int
     */
    public function countElement()
    {
        return count($this->elements);
    }

    /**
     * @param string $className
     * @return array
     */
    private function getElementByClassName($className)
    {
        $elements = array();

        foreach ($this->elements as $value) {
            if ($value instanceof $className) {
                $elements[] = $value;
            }
        }

        return $elements;
    }

    /**
     * @param Element $element
     *
     * @return bool
     */
    private function alreadyExist(Element $element)
    {
        foreach ($this->elements as $value) {
            if (true === $value->isEqual($element)) {
                return true;
            }
        }

        return false;
    }
}