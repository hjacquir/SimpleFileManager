<?php

/**
 * Created by Hatim Jacquir
 * @author : Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj\Mapper;

use Hj\Exception\NullArgumentException;
use Hj\File\Mp3\Elements\Interpreter;
use Hj\File\Mp3\Elements\Title;

/**
 * Class InterpreterMapper
 * @package Hj\Mapper
 */
class InterpreterMapper implements Mapper
{
    /**
     * @var string
     */
    private $markerForOriginal;

    /**
     * @var array
     */
    private $arrayOfInterpreter= array();

    /**
     * @param array $arrayOfInterpreter
     */
    public function setArrayOfInterpreter(Array $arrayOfInterpreter)
    {
        $this->arrayOfInterpreter = $arrayOfInterpreter;
    }

    /**
     * @return Interpreter
     */
    public function mapToObject()
    {
        $this->guardAgainstArgumentNotSet();

        $interpreter = new Interpreter();

        foreach ($this->arrayOfInterpreter as $key => $value) {
            $setter = 'set';

            if ($key === 'Original') {
                $value = $this->isOriginal($value);
            }

            if ($key === 'Title') {
                $title = new Title();
                $title->setName($value);
                $title->setYear('2005');

                $setter = 'add';
                $value = $title;
            }

            $method = $setter . $key;

            $interpreter->{$method}($value);
        }

        return $interpreter;
    }

    /**
     * @param string $markerForOriginal
     */
    public function setMarkerForOriginal($markerForOriginal)
    {
        $this->markerForOriginal = $markerForOriginal;
    }

    /**
     * @param string $value
     *
     * @return bool
     */
    private function isOriginal($value)
    {
        return $this->markerForOriginal === $value;
    }

    /**
     * @throws \Hj\Exception\NullArgumentException
     */
    private function guardAgainstArgumentNotSet()
    {
        $attributes = get_object_vars($this);

        $key = array_search(null, $attributes);

        if (false !== $key) {
            throw new NullArgumentException("The mapper is not initialized correctly. You must set the {$key}");
        }
    }
}