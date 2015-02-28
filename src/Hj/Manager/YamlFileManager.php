<?php

/**
 * Created by Hatim Jacquir
 * @author : Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj\Manager;

/**
 * Class YamlFileManager
 * @package Hj\Manager
 */
class YamlFileManager extends FileManager
{
    /**
     * @return array
     */
    public function getContent()
    {
        $resource = $this->getResource();

        return \Symfony\Component\Yaml\Yaml::parse(stream_get_contents($resource));
    }
}