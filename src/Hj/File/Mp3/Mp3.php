<?php

/**
 * Created by Hatim Jacquir
 * @author : Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj\File\Mp3;

use Hj\File\File;
use Hj\File\Mp3\Elements\Interpreter;
use Hj\File\Mp3\Elements\Title;

/**
 * Represent an mp3 file
 *
 * Class Mp3
 * @package Hj\File\Mp3
 *
 * @todo add unit test
 */
class Mp3 implements File
{
    const CLASS_NAME = __CLASS__;

    /**
     * @var string
     */
    private $name;

    /**
     * @var Interpreter
     */
    private $interpreter;

    /**
     * @var Title
     */
    private $title;

    /**
     * @param string $name
     * @param Interpreter $interpreter
     * @param Title $title
     */
    public function __construct($name, Interpreter $interpreter, Title $title)
    {
        $this->name = $name;
        $this->interpreter = $interpreter;
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getExtension()
    {
        return 'mp3';
    }
}