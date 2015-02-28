<?php

/**
 * Created by Hatim Jacquir
 * @author : Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj\Loader;

use Hj\Manager\CsvFileManager;
use Hj\Manager\FileManager;

/**
 * Class CsvLoader
 * @package Hj\Loader
 *
 * @todo add unit and functional test
 */
class CsvLoader implements Loader
{
    const CLASS_NAME = __CLASS__;

    /**
     * @var FileManager
     */
    private $fileManager;

    /**
     * @var array
     */
    private $content = array();

    /**
     * @param CsvFileManager $fileManager
     */
    public function __construct(FileManager $fileManager)
    {
        $this->fileManager = $fileManager;
    }

    /**
     * @void
     */
    public function loadData()
    {
        $csv = $this->fileManager->getCsv();

        $this->fileManager->open($csv->getFilename());

        $this->content = $this->fileManager->getContent();

        $this->fileManager->close();
    }

    /**
     * @return array
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return \Hj\Manager\CsvFileManager
     */
    public function getFileManager()
    {
        return $this->fileManager;
    }
}