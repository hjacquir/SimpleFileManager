<?php

/**
 * Created by Hatim Jacquir
 * @author : Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Loader\YamlFileLoader;
use Symfony\Component\Routing\RouteCollection;

/**
 * Load all routes defined into route.yml
 *
 * Class RouteLoader
 * @package Hj
 */
class RouteLoader
{
    /**
     * @return RouteCollection
     */
    public function getRoutes()
    {
        $fileLocator = new FileLocator(array(__DIR__ . '/../../config/'));

        $loader = new YamlFileLoader($fileLocator);

        $collection = $loader->load('route.yml');

        return $collection;
    }
}