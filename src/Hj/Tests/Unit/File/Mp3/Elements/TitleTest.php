<?php

/**
 * Created by Hatim Jacquir
 * @author : Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj\Tests\Unit\File\Mp3\Elements;

use Hj\File\Mp3\Elements\Interpreter;
use Hj\File\Mp3\Elements\Title;

/**
 * Class TitleTest
 * @package Hj\Tests\Unit\File\Mp3\Elements
 *
 * @covers Hj\File\Mp3\Elements\Title
 */
class TitleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Title
     */
    private $title;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $interpreter;

    public function setUp()
    {
        $this->interpreter = $this->getMockInterpreter();

        $this->title = new Title();
    }

    /**
     * @dataProvider provideDataForTestingSetAndGetMethods
     *
     * @param string $setterMethod
     * @param string $getterMethod
     * @param mixed $expectedValue
     */
    public function testShouldAndGetAttributes($setterMethod, $getterMethod, $expectedValue)
    {
        $this->title->{$setterMethod}($expectedValue);

        $this->assertSame($expectedValue, $this->title->{$getterMethod}());
    }

    /**
     * @return array
     */
    public function provideDataForTestingSetAndGetMethods()
    {
        return array(
            'Should set and get the id' => array(
                'setId',
                'getId',
                457896,
            ),
            'Should set and get the name' => array(
                'setName',
                'getName',
                'hello world',
            ),
            'Should set and get the year value' => array(
                'setYear',
                'getYear',
                2012,
            ),
        );
    }

    public function testShouldGetAndSetTheInterpreter()
    {
        $this->title->setInterpreter($this->interpreter);
        $this->assertSame($this->interpreter, $this->title->getInterpreter());
    }

    /**
     * @expectedException \Hj\Exception\NullArgumentException
     * @expectedExceptionMessage You must set the name before calling Hj\File\Mp3\Elements\Title::setUniqueId
     */
    public function testSetUniqueIdThrowAnExceptionWhenTheNameIsNotSetted()
    {
        $this->title->setUniqueId();
    }

    /**
     * @expectedException \Hj\Exception\NullArgumentException
     * @expectedExceptionMessage You must set the interpreter before calling Hj\File\Mp3\Elements\Title::setUniqueId
     */
    public function testSetUniqueIdThrowAnExceptionWhenTheNameIsSetteButTheInterpreterNot()
    {
        $this->title->setName('bla');
        $this->title->setUniqueId();
    }

    public function testShouldGetAndSetTheUniqueId()
    {
        $this->title->setName('bla');
        $this->interpreter
            ->expects($this->once())
            ->method('getUniqueId')
            ->will($this->returnValue('foo_bla'));

        $this->title->setInterpreter($this->interpreter);

        $this->title->setUniqueId();

        $this->assertSame('bla_foo_bla', $this->title->getUniqueId());
    }

    /**
     * @dataProvider provideDateTestingMethodIsEqual
     *
     * @param boolean $expectedValue
     * @param string $firstTitleUniqueId
     * @param string $titleName
     * @param string $interpreterUniqueId
     */
    public function testIsEqual($expectedValue, $firstTitleUniqueId, $titleName, $interpreterUniqueId)
    {
        $title2 = $this->getMockBuilder(Title::CLASS_NAME)
            ->disableOriginalConstructor()
            ->getMock();

        $title2
            ->expects($this->once())
            ->method('getUniqueId')
            ->will($this->returnValue($firstTitleUniqueId));

        $this->title->setName($titleName);

        $this->interpreter
            ->expects($this->once())
            ->method('getUniqueId')
            ->will($this->returnValue($interpreterUniqueId));

        $this->title->setInterpreter($this->interpreter);
        $this->title->setUniqueId();

        $this->assertSame($expectedValue, $this->title->isEqual($title2));
    }

    /**
     * @return array
     */
    public function provideDateTestingMethodIsEqual()
    {
        return array(
            'isEqual should return false when the title are different' => array(
                false,
                'bla',
                'foo',
                'foo_bla',
            ),
            'isEqual should return true when the title are equal' => array(
                true,
                'foo_foo_bla',
                'foo',
                'foo_bla',
            ),
        );
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function getMockInterpreter()
    {
        return $this->getMockBuilder(Interpreter::CLASS_NAME)->disableOriginalConstructor()->getMock();
    }
}