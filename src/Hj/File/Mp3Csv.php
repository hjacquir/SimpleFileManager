<?php

/**
 * Created by Hatim Jacquir
 * @author : Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj\File;

/**
 * Represent an Mp3 csv File
 *
 * Class Mp3Csv
 * @package Hj\File
 */
class Mp3Csv extends Csv
{
    /**
     * @return array
     */
    public function getColumns()
    {
        return array(
            'Name',
            'First Name',
            'Title',
            'Original',
            'Year',
        );
    }
}