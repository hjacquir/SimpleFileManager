<?php

/**
 * Created by Hatim Jacquir
 * @author : Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj\File;

use Hj\Exception\FileFormatException;
use Hj\Exception\FileNotFoundException;

abstract class File
{
    const CLASS_NAME = __CLASS__;

    /**
     * @var string
     */
    private $filename;

    /**
     * @param string $filename
     */
    public function __construct($filename)
    {
        $this->setFilename($filename);
    }

    /**
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @param string $filename
     *
     * @throws \Hj\Exception\FileNotFoundException
     * @throws \Hj\Exception\FileFormatException
     */
    private function setFilename($filename)
    {
        if (false === $this->fileExist($filename)) {
            throw new FileNotFoundException("The file does not exist");
        }

        if (false === $this->isSupported($filename)) {
            throw new FileFormatException("The file is not a {$this->getExtension()} file");
        }

        $this->filename = $filename;
    }

    /**
     * @param string $filename
     * @return bool
     */
    private function fileExist($filename)
    {
        return is_file($filename);
    }

    /**
     * @param string $filename
     *
     * @return bool
     */
    private function isSupported($filename)
    {
        $extension = pathinfo($filename, PATHINFO_EXTENSION);

        return $extension === $this->getExtension();
    }

    abstract public function getExtension();
}