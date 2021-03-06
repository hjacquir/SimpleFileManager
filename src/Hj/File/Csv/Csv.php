<?php

/**
 * Created by Hatim Jacquir
 * @author : Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj\File\Csv;

use Hj\File\File;

/**
 * Represent an csv file
 *
 * Class Csv
 * @package Hj\File\Csv
 */
abstract class Csv extends File
{
    const CLASS_NAME = __CLASS__;
    const DEFAULT_DELIMITER = ",";
    const DEFAULT_ENCLOSURE = '"';
    const DEFAULT_ESCAPE = "\\";

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
    public function __construct(
        $filename,
        $delimiter = self::DEFAULT_DELIMITER,
        $enclosure = self::DEFAULT_ENCLOSURE,
        $escape = self::DEFAULT_ESCAPE
    ) {
        parent::__construct($filename);

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
    public function getExtension()
    {
        return 'csv';
    }

    /**
     * @return array
     */
    abstract public function getColumns();
}