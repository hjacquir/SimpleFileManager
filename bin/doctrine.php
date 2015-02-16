<?php

/**
 * Using to manage the simple file manager database with doctrine
 *
 * Created by Hatim Jacquir
 * @author : Hatim Jacquir <jacquirhatim@gmail.com>
 */

require_once __DIR__ . '/../vendor/autoload.php';

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Version;
use Hj\DatabaseManager;
use Symfony\Component\Console\Application;

$entityManager = DatabaseManager::getEntityManager();

$helperSet = ConsoleRunner::createHelperSet($entityManager);

$application = new Application('Doctrine Command Line Interface', Version::VERSION);
$application->setCatchExceptions(true);
$application->setHelperSet($helperSet);

ConsoleRunner::addCommands($application);

$application->run();