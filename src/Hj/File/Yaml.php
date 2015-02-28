<?php

/**
 * Created by Hatim Jacquir
 * @author : Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj\File;

/**
 * Represent an Yaml file
 *
 * Class Yaml
 * @package Hj\File
 */
class Yaml extends File
{
    /**
     * @return string
     */
    public function getExtension()
    {
        return 'yml';
    }
}