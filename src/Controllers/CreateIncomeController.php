<?php

namespace FinanceApp\Controllers;

use Doctrine\ORM\EntityManagerInterface;
use FinanceApp\Controllers\Interface\BaseController;
use FinanceApp\Infra\EntityManagerCreator;
use FinanceApp\Models\Income;

class CreateIncomeController implements BaseController
{
    private EntityManagerInterface $entityManager;

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

        $income = new Income();
        $income->setDescription($description);
        $income->setAmount($amount);
        $income->setDate($date);
        $this->entityManager->persist($income);
        $this->entityManager->flush();
    }
}