<?php

/**
 * Created by Hatim Jacquir
 * @author : Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj\Manager;

use Hj\File\Csv;
use Hj\Transformer\ArrayTransformer;

/**
 * Class CsvFileManager
 * @package Hj\Manager
 *
 * @todo add unit and functional test
 */
class CsvFileManager extends FileManager
{
    /**
     * @var Csv
     */
    private $csv;

    /**
     * @param Csv $csv
     */
    public function __construct(Csv $csv)
    {
        $this->csv = $csv;
    }

    /**
     * @return array
     */
    public function getContent()
    {
        $content = array();

        $resource = $this->getResource();

        $delimiter = $this->csv->getDelimiter();
        $enclosure = $this->csv->getEnclosure();
        $escape = $this->csv->getEscape();

        $header = $this->getHeader($resource, $delimiter, $enclosure, $escape);

        $header = ArrayTransformer::camelCaseKey($header, true);

        while (false !== ($row = fgetcsv($resource, null, $delimiter, $enclosure, $escape))) {
            $row = ArrayTransformer::convertToAssociativeArray($header, $row);
            $content[] = $row;
        }

        return $content;
    }

    /**
     * @return Csv
     */
    public function getCsv()
    {
        return $this->csv;
    }

    /**
     * @param resource $resource
     * @param string $delimiter
     * @param string $enclosure
     * @param string $escape
     *
     * @return array
     */
    private function getHeader($resource, $delimiter, $enclosure, $escape)
    {
        return fgetcsv($resource, null, $delimiter, $enclosure, $escape);
    }
}