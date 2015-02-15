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
    private $entityManager;

    /**
     * @param ApcCache $cache
     * @param Configuration $configuration
     * @param array $connexion
     */
    public function __construct(ApcCache $cache, Configuration $configuration, array $connexion)
    {
        $driver = new XmlDriver(array(__DIR__ . '/Mapping/'));

        $configuration->setProxyDir(__DIR__ . '/doctrineProxies/');
        $configuration->setProxyNamespace('DoctrineProxy');
        $configuration->setMetadataDriverImpl($driver);
        $configuration->setMetadataCacheImpl($cache);
        $configuration->setQueryCacheImpl($cache);

        $this->entityManager = EntityManager::create($connexion, $configuration);
    }

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }
}