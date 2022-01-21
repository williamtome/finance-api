<?php

namespace FinanceApp\Infra;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Setup;

class EntityManagerCreator
{
    public function getEntityManager(): EntityManagerInterface
    {
        $rootDir = __DIR__ . '/../..';
        $isDevMode = true;

        $config = Setup::createAnnotationMetadataConfiguration([$rootDir . '/src/Models'], $isDevMode);

        $connectionParams = [
            'driver' => 'pdo_sqlite',
            'path' => $rootDir . '/banco.sqlite'
        ];

        return EntityManager::create($connectionParams, $config);
    }
}