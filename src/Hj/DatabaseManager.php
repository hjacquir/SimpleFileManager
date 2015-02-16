<?php

/**
 * Created by Hatim Jacquir
 * @author : Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj;

use Doctrine\Common\Cache\ApcCache;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\XmlDriver;

/**
 * I manage the database by using Doctrine Entity Manager
 * I use APCCache with Doctrine
 * I use Xml Mapping File
 *
 * Class DatabaseManager
 * @package Hj
 */
class DatabaseManager
{
    /**
     * @var EntityManager
     */
    private static $entityManager = null;

    /**
     * @var Configuration
     */
    private static $configuration;

    /**
     * @var array
     */
    private static $connexion;

    /**
     * @return EntityManager
     */
    public static function getEntityManager()
    {
        if (true === is_null(self::$entityManager)) {
            self::configure();
            self::$entityManager = EntityManager::create(self::$connexion, self::$configuration);
        }

        return self::$entityManager;
    }

    /**
     * @void
     */
    private static function configure()
    {
        $cache = new ApcCache();

        $driver = new XmlDriver(array(__DIR__ . '/Mapping/'));

        self::$configuration = new Configuration();
        self::$configuration->setProxyDir(__DIR__ . '/doctrineProxies/');
        self::$configuration->setProxyNamespace('DoctrineProxy');
        self::$configuration->setMetadataDriverImpl($driver);
        self::$configuration->setMetadataCacheImpl($cache);
        self::$configuration->setQueryCacheImpl($cache);

        self::$connexion = array(
            'driver' => 'pdo_mysql',
            'host' => 'localhost',
            'user' => 'root',
            'password' => 'root',
            'dbname' => 'simplefilemanager',
        );
    }
}