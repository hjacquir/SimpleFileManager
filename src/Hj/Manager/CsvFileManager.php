<?php

/**
 * Created by Hatim Jacquir
 * @author : Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj\Manager;

use Hj\File\Csv;
use Hj\Transformer\ArrayTransformer;
use Hj\Validator\CsvHeaderValidator;

/**
 * Class CsvFileManager
 * @package Hj\Manager
 *
 * @todo add unit and functional test
 */
class CsvFileManager extends FileManager
{
    const CLASS_NAME = __CLASS__;

    /**
     * @var Csv
     */
    private $csv;

    /**
     * @var CsvHeaderValidator
     */
    private $csvHeaderValidator;

    /**
     * @param Csv $csv
     * @param CsvHeaderValidator $csvHeaderValidator
     */
    public function __construct(Csv $csv, CsvHeaderValidator $csvHeaderValidator)
    {
        $this->csv = $csv;
        $this->csvHeaderValidator = $csvHeaderValidator;
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

        $this->validHeader($header);

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
     * @param $header
     */
    private function validHeader($header)
    {
        $this->csvHeaderValidator->setCurrentHeader($header);
        $this->csvHeaderValidator->setExpectedHeader($this->csv->getColumns());
        $this->csvHeaderValidator->valid();
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