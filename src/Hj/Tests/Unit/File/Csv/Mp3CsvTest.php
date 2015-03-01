<?php

/**
 * Created by Hatim Jacquir
 * @author : Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj\Tests\Unit\File\Csv;

use Hj\File\Csv\Csv;
use Hj\File\Csv\Mp3Csv;

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
    private $file;

    /**
     * @var string
     */
    private $filename;

    public function setUp()
    {
        $this->filename = __DIR__ . '/../fixtures/foo.csv';

        $this->file = new Mp3Csv($this->filename);
    }

    /**
     * @param string $filename
     * @return Mp3Csv
     */
    public function generateMp3Csv($filename)
    {
        return new Mp3Csv($filename);
    }

    /**
     * @expectedException \Hj\Exception\FileNotFoundException
     * @expectedExceptionMessage The file does not exist
     */
    public function testShouldThrowAnExceptionWhenTheFileDoesNotExist()
    {
        $this->generateMp3Csv('fileDoesNotExist');
    }

    /**
     * @expectedException \Hj\Exception\FileFormatException
     * @expectedExceptionMessage The file is not a csv file
     */
    public function testShouldThrowAnExceptionWhenTheFileExistButIsNotAnCsv()
    {
        $this->generateMp3Csv(__DIR__ . '/../fixtures/foo.txt');
    }

    public function testShouldGetTheFilename()
    {
        $this->assertSame($this->filename, $this->file->getFilename());
    }

    public function testShouldGetTheDefaultDelimiter()
    {
        $this->assertSame(Csv::DEFAULT_DELIMITER, $this->file->getDelimiter());
    }

    public function testShouldGetTheDefaultEnclosure()
    {
        $this->assertSame(Csv::DEFAULT_ENCLOSURE, $this->file->getEnclosure());
    }

    public function testShouldGetTheDefaultEscape()
    {
        $this->assertSame(Csv::DEFAULT_ESCAPE, $this->file->getEscape());
    }

    public function testShouldOverrideTheDefaultDelimiterEnclosureAndEscapeValues()
    {
        $delimiter = 'delimiter';
        $escape = 'escape';
        $enclosure = 'enclosure';

        $file = new Mp3Csv($this->filename, $delimiter, $enclosure, $escape);

        $this->assertSame($delimiter, $file->getDelimiter());
        $this->assertSame($enclosure, $file->getEnclosure());
        $this->assertSame($escape, $file->getEscape());
    }

    public function testShouldGetExtension()
    {
        $this->assertSame('csv', $this->file->getExtension());
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

        $this->assertSame($columns, $this->file->getColumns());
    }
}