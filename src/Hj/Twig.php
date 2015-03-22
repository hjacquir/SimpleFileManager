<?php

/**
 * Created by Hatim Jacquir
 * @author : Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj;

/**
 * Wrap Twig and provide an configured twig environment instance
 *
 * Class Twig
 * @package Hj
 */
class Twig
{
    /**
     * @var \Twig_Environment
     */
    private $environment;

    /**
     * @param \Twig_Loader_Filesystem $loader
     * @param \Twig_Environment $environment
     */
    public function __construct(\Twig_Loader_Filesystem $loader, \Twig_Environment $environment)
    {
        $paths = array(
            __DIR__ . '/View/',
            /** the view path */
            __DIR__ . '/../../vendor/symfony/twig-bridge/Symfony/Bridge/Twig/Resources/views/Form',
            /** the twig bridge form view path */
        );

        $loader->setPaths($paths);

        $this->environment = $environment;
        $this->environment->setLoader($loader);
        $this->environment->setCache(__DIR__ . '/../../cache/twig/');
    }

    /**
     * @return \Twig_Environment
     */
    public function getEnvironment()
    {
        return $this->environment;
    }
}