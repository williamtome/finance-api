<?php

namespace FinanceApp\Controllers;

use Doctrine\ORM\EntityRepository;
use FinanceApp\Controllers\Interface\BaseController;
use FinanceApp\Infra\EntityManagerCreator;
use FinanceApp\Models\Income;

class ListIncomeController implements BaseController
{
    private EntityRepository $incomeRepository;

    public function __construct()
    {
        $entityManager = (new EntityManagerCreator())->getEntityManager();
        $this->incomeRepository = $entityManager->getRepository(Income::class);
    }

    public function processRequest()
    {
        $incomes = $this->incomeRepository->findAll();
        $this->formatResult($incomes);
    }

    protected function formatResult(array $result)
    {
        echo "<pre>";
        print_r($result);
        echo "</pre>";
    }
}