<?php

/**
 * Created by Hatim Jacquir
 * @author : Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj\Tests\Unit\Collection;

use Hj\Collection\ElementCollection;
use Hj\File\Mp3\Elements\Interpreter;
use Hj\File\Mp3\Elements\Title;

/**
 * Class ElementCollectionTest
 * @package Hj\Tests\Unit\Collection
 *
 * @covers Hj\Collection\ElementCollection
 */
class ElementCollectionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ElementCollection
     */
    private $collection;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $element;

    public function setUp()
    {
        $this->element = $this->getMockElement();
        $this->collection = new ElementCollection();
    }

    public function testShouldAddElementWhenElementAlreadyNotAdded()
    {
        $this->assertSame(0, $this->collection->countElement());
        $this->collection->add($this->element);
        $this->assertSame(1, $this->collection->countElement());
    }

    public function testShouldNotAddElementWhenElementIsAlreadyAdded()
    {
        $this->element2 = $this->getMockElement();

        $this->element
            ->expects($this->once())
            ->method('isEqual')
            ->with($this->element2)
            ->will($this->returnValue(true));

        $this->assertSame(0, $this->collection->countElement());
        $this->collection->add($this->element);
        $this->assertSame(1, $this->collection->countElement());
        $this->collection->add($this->element2);
        $this->assertSame(1, $this->collection->countElement());
    }

    public function testShouldGetInterpretersShouldReturnAnArrayOfInterpreter()
    {
        $interpreter1 = $this->getMockInterpreter();
        $interpreter2 = $this->getMockInterpreter();

        $interpreters = array(
            $interpreter1,
            $interpreter2,
        );

        $this->collection->add($interpreter1);
        $this->collection->add($interpreter2);

        $this->assertSame($interpreters, $this->collection->getInterpreters());
    }

    public function testShouldGetTitlesShouldReturnAnArrayOfTitles()
    {
        $title1 = $this->getMockTitle();
        $title2 = $this->getMockTitle();

        $titles = array(
            $title1,
            $title2,
        );

        $this->collection->add($title1);
        $this->collection->add($title2);

        $this->assertSame($titles, $this->collection->getTitles());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function getMockTitle()
    {
        return $this->getMockBuilder(Title::CLASS_NAME)
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function getMockInterpreter()
    {
        return $this->getMockBuilder(Interpreter::CLASS_NAME)
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function getMockElement()
    {
        return $this->getMockBuilder('Hj\File\Mp3\Elements\Element')->getMock();
    }
}