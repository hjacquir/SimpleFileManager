<?php

/**
 * Created by Hatim Jacquir
 * @author : Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj\Tests\Unit\File\Mp3;

use Hj\File\Mp3\Elements\Interpreter;
use Hj\File\Mp3\Elements\Title;
use Hj\File\Mp3\Mp3;

/**
 * Class Mp3Test
 * @package Hj\Tests\Unit\File\Mp3
 *
 * @covers Hj\File\Mp3\Mp3
 */
class Mp3Test extends \PHPUnit_Framework_TestCase
{
    public function testShouldGetExtensionShouldReturnMp3()
    {
        $interpreter = $this->getMockBuilder(Interpreter::CLASS_NAME)->disableOriginalConstructor()->getMock();
        $title = $this->getMockBuilder(Title::CLASS_NAME)->disableOriginalConstructor()->getMock();

        $mp3 = new Mp3('foo', $interpreter, $title);

        $this->assertSame('mp3', $mp3->getExtension());
    }
}