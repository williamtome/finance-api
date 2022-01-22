<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use FinanceApp\Infra\EntityManagerCreator;

// replace with file to your own project bootstrap
require_once __DIR__ . '/vendor/autoload.php';

// replace with mechanism to retrieve EntityManager in your app
$entityManager = (new EntityManagerCreator())->getEntityManager();

return ConsoleRunner::createHelperSet($entityManager);
