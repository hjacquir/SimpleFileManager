<?php

/**
 * Created by Hatim Jacquir
 * @author : Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj\Manager;

/**
 * Class File
 * @package Hj\Manager
 */
abstract class FileManager
{
    /**
     * @var resource
     */
    private $resource;

    /**
     * Open a file and return the resource
     *
     * @param string $filename
     * @param string $mode
     *
     * @return resource
     */
    public function open($filename, $mode = 'r')
    {
        $this->resource = fopen($filename, $mode);

        return $this->resource;
    }

    /**
     * @void
     */
    public function close()
    {
        fclose($this->resource);
    }

    /**
     * @return resource
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * @return mixed
     */
    abstract public function getContent();
}