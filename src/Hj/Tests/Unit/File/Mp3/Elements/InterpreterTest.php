<?php

/**
 * Created by Hatim Jacquir
 * @author : Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj\Tests\Unit\File\Mp3\Elements;

use Hj\File\Mp3\Elements\Interpreter;

/**
 * Class InterpreterTest
 * @package Hj\Tests\Unit\File\Mp3\Elements
 *
 * @covers Hj\File\Mp3\Elements\Interpreter
 */
class InterpreterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Interpreter
     */
    private $interpreter;

    public function setUp()
    {
        $this->interpreter = new Interpreter();
    }

    /**
     * @dataProvider provideDataForTestingSetAndGetMethods
     *
     * @param string $setterMethod
     * @param string $getterMethod
     * @param mixed $expectedValue
     */
    public function testShouldSetAndGetAttributes($setterMethod, $getterMethod, $expectedValue)
    {
        $this->interpreter->{$setterMethod}($expectedValue);

        $this->assertSame($expectedValue, $this->interpreter->{$getterMethod}());
    }

    /**
     * @return array
     */
    public function provideDataForTestingSetAndGetMethods()
    {
        return array(
            'Should set and get the id' => array(
                'setId', 'getId', 457896,
            ),
            'Should set and get the name' => array(
                'setName', 'getName', 'hello world',
            ),
            'Should set and get the first name' => array(
                'setFirstname', 'getFirstname', 'foo bar',
            ),
            'Should set and get the original value' => array(
                'setOriginal', 'isOriginal', true,
            ),
        );
    }

    /**
     * @expectedException \Hj\Exception\NullArgumentException
     * @expectedExceptionMessage You must set the name before calling Hj\File\Mp3\Elements\Interpreter::setUniqueId
     */
    public function testSetUniqueIdThrowAnExceptionWhenTheNameIsNotSetted()
    {
        $this->interpreter->setUniqueId();
    }

    /**
     * @expectedException \Hj\Exception\NullArgumentException
     * @expectedExceptionMessage You must set the first name before calling Hj\File\Mp3\Elements\Interpreter::setUniqueId
     */
    public function testSetUniqueIdThrowAnExceptionWhenTheNameIsSetButTheFirstNameNotSet()
    {
        $this->interpreter->setName('bla');
        $this->interpreter->setUniqueId();
    }

    public function testShouldGetAndSetTheUniqueId()
    {
        $this->interpreter->setName('bla');
        $this->interpreter->setFirstName('hello');

        $this->interpreter->setUniqueId();

        $this->assertSame('bla_hello', $this->interpreter->getUniqueId());
    }

    public function testIsEqualShouldReturnFalseWhenInterpreterAreDifferent()
    {
        $interpreter2 = $this->getMockBuilder(Interpreter::CLASS_NAME)
            ->disableOriginalConstructor()
            ->getMock();

        $interpreter2
            ->expects($this->once())
            ->method('getUniqueId')
            ->will($this->returnValue('bla'));

        $this->interpreter->setName('foo');
        $this->interpreter->setFirstName('hello');
        $this->interpreter->setUniqueId();

        $this->assertFalse($this->interpreter->isEqual($interpreter2));
    }

    /**
     * @dataProvider provideDateTestingMethodIsEqual
     *
     * @param string $valueGetUniqueId
     * @param string $name
     * @param string $firstName
     * @param bool $expectedValue
     */
    public function testIsEqual($valueGetUniqueId, $name, $firstName, $expectedValue)
    {
        $interpreter2 = $this->getMockBuilder(Interpreter::CLASS_NAME)
            ->disableOriginalConstructor()
            ->getMock();

        $interpreter2
            ->expects($this->once())
            ->method('getUniqueId')
            ->will($this->returnValue($valueGetUniqueId));

        $this->interpreter->setName($name);
        $this->interpreter->setFirstName($firstName);
        $this->interpreter->setUniqueId();

        $this->assertSame($expectedValue, $this->interpreter->isEqual($interpreter2));
    }

    /**
     * @return array
     */
    public function provideDateTestingMethodIsEqual()
    {
        return array(
            'isEqual should return false when the interpreter are different' => array(
                'foo_bar',
                'foo',
                'hello',
                false,
            ),
            'isEqual should return true when the interpreter are the same' => array(
                'foo_bar',
                'foo',
                'bar',
                true,
            ),
        );
    }
}