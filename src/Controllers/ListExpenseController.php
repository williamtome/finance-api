<?php

namespace FinanceApp\Controllers;

use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ObjectRepository;
use FinanceApp\Controllers\Interface\BaseController;
use FinanceApp\Infra\EntityManagerCreator;
use FinanceApp\Models\Expense;

class ListExpenseController implements BaseController
{
    private ObjectRepository|EntityRepository $expenseRepository;

    public function __construct()
    {
        $entityManager = (new EntityManagerCreator())->getEntityManager();
        $this->expenseRepository = $entityManager->getRepository(Expense::class);
    }

    public function processRequest()
    {
        $expenses = $this->expenseRepository->findAll();

        print_r($this->serialize($expenses));
    }

    protected function serialize(array $expenses): bool|string
    {
        return json_encode($expenses);
    }
}
