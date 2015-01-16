<?php

/**
 * Created by Hatim Jacquir
 * @author : Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj\File;

use Hj\Exception\FileFormatException;
use Hj\Exception\FileNotFoundException;

/**
 * Represent an csv file
 *
 * Class Csv
 * @package Hj\File
 */
class Csv implements File
{
    const CLASS_NAME = __CLASS__;

    /**
     * @var string
     */
    private $filename;

    /**
     * @var string
     */
    private $delimiter;

    /**
     * @var string
     */
    private $enclosure;

    /**
     * @var string
     */
    private $escape;

    /**
     * @param string $filename
     * @param string $delimiter
     * @param string $enclosure
     * @param string $escape
     */
    public function __construct($filename, $delimiter = ",", $enclosure = '"', $escape = "\\")
    {
        $this->setFilename($filename);

        $this->delimiter = $delimiter;
        $this->enclosure = $enclosure;
        $this->escape = $escape;
    }

    /**
     * @return string
     */
    public function getDelimiter()
    {
        return $this->delimiter;
    }

    /**
     * @return string
     */
    public function getEnclosure()
    {
        return $this->enclosure;
    }

    /**
     * @return string
     */
    public function getEscape()
    {
        return $this->escape;
    }

    /**
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @return string
     */
    public function getExtension()
    {
        return 'csv';
    }

    /**
     * @param string $filename
     *
     * @return bool
     */
    private function isAnCsvFile($filename)
    {
        $extension = pathinfo($filename, PATHINFO_EXTENSION);

        return $extension === $this->getExtension();
    }

    /**
     * @param string $filename
     *
     * @throws \Hj\Exception\FileNotFoundException
     * @throws \Hj\Exception\FileFormatException
     */
    private function setFilename($filename)
    {
        if (false === is_file($filename)) {
            throw new FileNotFoundException("The file {$filename} does not exist");
        }

        if (false === $this->isAnCsvFile($filename)) {
            throw new FileFormatException("The file {$filename} is not an csv file");
        }

        $this->filename = $filename;
    }
}