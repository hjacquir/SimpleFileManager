<?php

/**
 * Created by Hatim Jacquir
 * @author : Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj\Mapper;

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
     * @param Interpreter $interpreter
     */
    public function __construct(Interpreter $interpreter)
    {
        $this->interpreter = $interpreter;
    }

    /**
     * @return Title
     */
    public function map()
    {
        $array = $this->getArray();

        $title = new Title();
        $title->setYear($array['Year']);
        $title->setName($array['Title']);
        $title->setInterpreter($this->interpreter);
        $title->setUniqueId();

        return $title;
    }
}