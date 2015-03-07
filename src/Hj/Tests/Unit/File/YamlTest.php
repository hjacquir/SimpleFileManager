<?php

/**
 * Created by Hatim Jacquir
 * @author : Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj\Tests\Unit\File;

use Hj\File\Yaml;
use org\bovigo\vfs\vfsStream;

/**
 * Class YamlTest
 * @package Hj\Tests\Unit\File
 *
 * @covers Hj\File\Yaml
 */
class YamlTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldGetExtension()
    {
        $root = vfsStream::setup('home');
        $file = vfsStream::newFile('bla.yml')->at($root);

        $yaml = new Yaml($file->url());

        $this->assertSame('yml', $yaml->getExtension());
    }
}