<?php

/**
 * Created by Hatim Jacquir
 * @author : Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj\Twig;

use Twig_Environment;
use Twig_Loader_Filesystem;

/**
 * Represent a template renderer
 *
 * Class Renderer
 * @package Hj\Twig
 */
class Renderer
{
    /**
     * @var Twig_Environment
     */
    private static $twig = null;

    /**
     * @return Twig_Environment
     */
    public static function getTwig()
    {
        if (true === is_null(self::$twig)) {
            self::configure();
        }

        return self::$twig;
    }

    /**
     * @void
     */
    private static function configure()
    {
        $loader = new Twig_Loader_Filesystem(__DIR__ . '/../View/');
        $options = array('cache' => __DIR__ . '/cache/');

        self::$twig = new Twig_Environment($loader, $options);
    }
}