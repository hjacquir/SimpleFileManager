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
 * Class TitleMapper
 * @package Hj\Mapper
 */
class TitleMapper extends ObjectMapper
{
    /**
     * @var Interpreter
     */
    private $interpreter;

    /**
     * @return Title
     */
    public function map()
    {
        $array = $this->getArray();

        $title = new Title();
        $title->setYear($array['Year']);
        $title->setName($array['Title']);

        $this->guardAgainstInterpreterNotSet();

        $title->setInterpreter($this->interpreter);
        $title->setUniqueId();

        return $title;
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
     * @throws \Hj\Exception\NullArgumentException
     */
    private function guardAgainstInterpreterNotSet()
    {
        if (null === $this->interpreter) {
            throw new NullArgumentException('You must set the Intepreter for the title');
        }
    }
}