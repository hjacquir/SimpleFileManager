<?php

/**
 * Created by Hatim Jacquir
 * @author : Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj\Collection;

use Hj\Exception\ClassNotFoundException;
use Hj\File\Mp3\Elements\Element;
use Hj\File\Mp3\Elements\Interpreter;
use Hj\File\Mp3\Elements\Title;

/**
 * Class ElementCollection
 * @package Hj\Collection
 *
 * @todo add tests
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
     * @param string $className
     * @return array
     */
    private function getElementByClassName($className)
    {
        $this->guardAgainstClassIsNotAnElement($className);

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

    /**
     * @param string $className
     * @throws \Hj\Exception\ClassNotFoundException
     */
    private function guardAgainstClassIsNotAnElement($className)
    {
        $class = new \ReflectionClass($className);

        if (false == $class->implementsInterface('Hj\File\Mp3\Elements\Element')) {
            throw new ClassNotFoundException("The class {$class->getName()} does not exist or she is not an Element");
        }
    }
}