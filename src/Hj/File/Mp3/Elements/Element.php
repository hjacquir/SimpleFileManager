<?php

/**
 * Created by Hatim Jacquir
 * @author : Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj\File\Mp3\Elements;

/**
 * Interface Element
 * @package Hj\File\Mp3\Elements
 */
interface Element
{
    /**
     * @param Element $element
     *
     * @return bool
     */
    public function isEqual(Element $element);

    /**
     * @return string
     */
    public function getUniqueId();
}