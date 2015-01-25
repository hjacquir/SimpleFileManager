<?php

/**
 * Created by Hatim Jacquir
 * @author : Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj\Mapper;

use Hj\File\Mp3\Elements\Interpreter;

/**
 * Class InterpreterMapper
 * @package Hj\Mapper
 */
class InterpreterMapper extends ObjectMapper
{
    /**
     * @return Interpreter
     */
    public function map()
    {
        $array = $this->getArray();

        $original = 'Y' === $array['Original'];

        $interpreter = new Interpreter();
        $interpreter->setName($array['Name']);
        $interpreter->setFirstName($array['FirstName']);
        $interpreter->setOriginal($original);
        $interpreter->setUniqueId();

        return $interpreter;
    }
}