<?php

/**
 * Created by Hatim Jacquir
 * @author : Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj\Manager;

use Hj\File\Csv;

/**
 * Class CsvFileManager
 * @package Hj\Manager
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

        while (false !== ($row = fgetcsv($resource, null, $delimiter, $enclosure, $escape))) {
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
}