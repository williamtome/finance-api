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
        $income = new Income();
        $income->setDescription($_POST['description']);
        $income->setAmount($_POST['amount']);
        $income->setDate($_POST['date']);
        $this->entityManager->persist($income);
        $this->entityManager->flush();
    }
}