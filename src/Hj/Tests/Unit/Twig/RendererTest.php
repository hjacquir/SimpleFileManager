<?php

/**
 * Created by Hatim Jacquir
 * @author : Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj\Tests\Unit\Twig;

use Hj\Twig\Renderer;

/**
 * Class RendererTest
 * @package Hj\Tests\Unit\Twig
 *
 * @covers \Hj\Twig\Renderer
 */
class RendererTest extends \PHPUnit_Framework_TestCase
{
    public function testGetTwigShouldReturnATwigEnvironment()
    {
        $twig = Renderer::getTwig();

        $this->assertInstanceOf('\Twig_Environment', $twig);
    }

    public function testGetTwigShouldReturnAnUniqueTwigEnvironment()
    {
        $twig1 = Renderer::getTwig();
        $twig2 = Renderer::getTwig();

        $this->assertSame($twig1, $twig2);
    }
}