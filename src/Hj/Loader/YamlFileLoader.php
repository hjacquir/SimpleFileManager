<?php

/**
 * Created by Hatim Jacquir
 * @author : Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj\Loader;

use Hj\File\File;
use Hj\Manager\FileManager;

/**
 * Load an Yaml File
 *
 * Class YamlFileLoader
 * @package Hj\Loader
 */
class YamlFileLoader implements Loader
{
    /**
     * @var string
     */
    private $loadedData;

    /**
     * @var FileManager
     */
    private $fileManager;

    /**
     * @var File
     */
    private $yamlFile;

    /**
     * @param FileManager $fileManager
     * @param File $yamlFile
     */
    public function __construct(FileManager $fileManager, File $yamlFile)
    {
        $this->fileManager = $fileManager;
        $this->yamlFile = $yamlFile;

    }

    /**
     * @void
     */
    public function loadData()
    {
        $filename = $this->yamlFile->getFilename();

        $this->fileManager->open($filename);

        $this->loadedData = $this->fileManager->getContent();

        $this->fileManager->close();
    }

    /**
     * @return string
     */
    public function getLoadedData()
    {
        return $this->loadedData;
    }
}