<?php

/**
 * Created by Hatim Jacquir
 * @author : Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj;

use Hj\Exception\ColumnNotFoundException;

/**
 * Class CsvHeaderValidator
 * @package Hj
 */
class CsvHeaderValidator
{
    /**
     * @var array
     */
    private $expectedHeader = array();

    /**
     * @var array
     */
    private $currentHeader = array();

    /**
     * @var array
     */
    private $diffHeader = array();

    /**
     * @param array $currentHeader
     */
    public function setCurrentHeader(array $currentHeader)
    {
        $this->currentHeader = $currentHeader;
    }

    /**
     * @return array
     */
    public function getCurrentHeader()
    {
        return $this->currentHeader;
    }

    /**
     * @return array
     */
    public function getDiffHeader()
    {
        return $this->diffHeader;
    }

    /**
     * @param array $expectedHeader
     */
    public function setExpectedHeader(array $expectedHeader)
    {
        $this->expectedHeader = $expectedHeader;
    }

    /**
     * @return array
     */
    public function getExpectedHeader()
    {
        return $this->expectedHeader;
    }

    /**
     * @void
     * @throws \Hj\Exception\ColumnNotFoundException
     */
    public function valid()
    {
        if (false === $this->areEqual()) {
            foreach ($this->diffHeader as $column) {
                throw new ColumnNotFoundException("The column : {$column} is missing to your csv file. Please add it");
            }
        }
    }

    /**
     * Compare two header and return true if they are equal
     *
     * @return bool
     */
    private function areEqual()
    {
        $this->compareHeader();

        return empty($this->diffHeader);
    }

    /**
     * Compare two header and return the diff header array
     *
     * @return array
     */
    private function compareHeader()
    {
        $this->diffHeader  = array_diff($this->expectedHeader, $this->currentHeader);
    }
}