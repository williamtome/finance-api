<?php

namespace FinanceApp\Infra;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Setup;

class EntityManagerCreator
{
    public function getEntityManager(): EntityManagerInterface
    {
        $paths = [__DIR__ . '/../Models'];
        $isDevMode = false;
        $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);

        $dbParams = [
            'url' => 'mysql://william:12345678@mysql/personal-finance',
        ];

        return EntityManager::create($dbParams, $config);
    }
}