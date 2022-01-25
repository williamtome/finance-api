<?php

namespace FinanceApp\Controllers;

use FinanceApp\Controllers\Interface\BaseController;
use FinanceApp\Infra\EntityManagerCreator;
use FinanceApp\Models\Expense;

class CreateExpenseController implements BaseController
{
    private \Doctrine\ORM\EntityManagerInterface $entityManager;

    public function __construct()
    {
        $this->entityManager = (new EntityManagerCreator())->getEntityManager();
    }

    public function processRequest()
    {
        $description = filter_input(
            INPUT_POST,
            'description',
            FILTER_SANITIZE_STRING
        );

        $amount = filter_input(
            INPUT_POST,
            'amount',
            FILTER_VALIDATE_FLOAT
        );

        $date = filter_input(
            INPUT_POST,
            'date',
            FILTER_SANITIZE_STRING
        );

        $expense = new Expense();
        $expense->setDescription($description);
        $expense->setAmount($amount);
        $expense->setDate($date);
        $this->entityManager->persist($expense);
        $this->entityManager->flush();
    }
}
