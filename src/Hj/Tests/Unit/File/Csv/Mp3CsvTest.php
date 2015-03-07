<?php

/**
 * Created by Hatim Jacquir
 * @author : Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj\Tests\Unit\File\Csv;

use Hj\File\Csv\Csv;
use Hj\File\Csv\Mp3Csv;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use org\bovigo\vfs\vfsStreamFile;

/**
 * Class Mp3CsvTest
 * @package Hj\Tests\Unit\File\Csv
 *
 * @covers Hj\File\Csv\Mp3Csv
 * @covers Hj\File\Csv\Csv
 * @covers Hj\File\File
 */
class Mp3CsvTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Mp3Csv
     */
    private $mp3Csv;

    /**
     * @var vfsStreamFile
     */
    private $file;

    /**
     * @var vfsStreamDirectory
     */
    private $directory;

    public function setUp()
    {
        $this->directory = vfsStream::setup('foo');

        $this->file = vfsStream::newFile('bla.csv')->at($this->directory);

        $this->mp3Csv = new Mp3Csv($this->file->getName());
    }

    /**
     * @expectedException \Hj\Exception\FileNotFoundException
     * @expectedExceptionMessage The file does not exist
     */
    public function testShouldThrowAnExceptionWhenTheFileDoesNotExist()
    {
        new Mp3Csv('notExist');
    }

    /**
     * @expectedException \Hj\Exception\FileFormatException
     * @expectedExceptionMessage The file is not a csv file
     */
    public function testShouldThrowAnExceptionWhenTheFileExistButIsNotAnCsv()
    {
        $file = vfsStream::newFile('bla')->at($this->directory);

        new Mp3Csv($file->url());
    }

    public function testShouldGetTheFilename()
    {
        $this->assertSame($this->file->getName(), $this->mp3Csv->getFilename());
    }

    public function testShouldGetTheDefaultDelimiter()
    {
        $this->assertSame(Csv::DEFAULT_DELIMITER, $this->mp3Csv->getDelimiter());
    }

    public function testShouldGetTheDefaultEnclosure()
    {
        $this->assertSame(Csv::DEFAULT_ENCLOSURE, $this->mp3Csv->getEnclosure());
    }

    public function testShouldGetTheDefaultEscape()
    {
        $this->assertSame(Csv::DEFAULT_ESCAPE, $this->mp3Csv->getEscape());
    }

    public function testShouldOverrideTheDefaultDelimiterEnclosureAndEscapeValues()
    {
        $delimiter = 'delimiter';
        $escape = 'escape';
        $enclosure = 'enclosure';

        $file = new Mp3Csv($this->file->getName(), $delimiter, $enclosure, $escape);

        $this->assertSame($delimiter, $file->getDelimiter());
        $this->assertSame($enclosure, $file->getEnclosure());
        $this->assertSame($escape, $file->getEscape());
    }

    public function testShouldGetExtension()
    {
        $this->assertSame('csv', $this->mp3Csv->getExtension());
    }

    public function testShouldGetColumns()
    {
        $columns = array(
            0 => 'Name',
            1 => 'First Name',
            2 => 'Title',
            3 => 'Original',
            4 => 'Year',
        );

        $this->assertSame($columns, $this->mp3Csv->getColumns());
    }
}