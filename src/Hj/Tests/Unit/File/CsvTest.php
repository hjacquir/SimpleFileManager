<?php
//
///**
// * Created by Hatim Jacquir
// * @author : Hatim Jacquir <jacquirhatim@gmail.com>
// */
//
//namespace Hj\Tests\Unit\File;
//
//use Hj\File\Csv;
//
///**
// * Class CsvTest
// * @package Hj\Tests\Unit\File
// *
// * @covers Hj\File\Csv
// */
//class CsvTest extends \PHPUnit_Framework_TestCase
//{
//    /**
//     * @var Csv
//     */
//    private $csv;
//
//    public function setUp()
//    {
//        $this->csv = new Csv(__DIR__ . '/foo.csv');
//    }
//
//    public function testShouldBeAFile()
//    {
//        $this->assertInstanceOf('Hj\File\File', $this->csv);
//    }
//
//    public function testShouldHaveAComaDelimiterByDefault()
//    {
//        $this->assertSame(',', $this->csv->getDelimiter());
//    }
//
//    public function testShouldHaveDoubleQuoteEnclosureByDefault()
//    {
//        $this->assertSame('"', $this->csv->getEnclosure());
//    }
//
//    public function testShouldHaveAntiSlashEscapeByDefault()
//    {
//        $this->assertSame('\\', $this->csv->getEscape());
//    }
//
//    /**
//     * @expectedException \Hj\Exception\FileNotFoundException
//     * @expectedExceptionMessage The file does not exist
//     */
//    public function testShouldThrowAnExceptionWhenTheFileDoesNotExist()
//    {
//        new Csv('INotExist.csv');
//    }
//
//    /**
//     * @expectedException \Hj\Exception\FileFormatException
//     * @expectedExceptionMessage The file is not a csv file
//     */
//    public function testShouldThrowAnExceptionWhenTheFileIsNotAnCsv()
//    {
//        new Csv(__DIR__ . '/foo.mp3');
//    }
//}