<?php

namespace FinanceApp\Controllers;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ObjectRepository;
use Exception;
use FinanceApp\Controllers\Interface\BaseController;
use FinanceApp\Infra\EntityManagerCreator;
use FinanceApp\Models\Expense;

class UpdateExpenseController implements BaseController
{
    private EntityManagerInterface $entityManager;
    private ObjectRepository|EntityRepository $expenseRepository;

    public function __construct()
    {
        $this->entityManager = (new EntityManagerCreator())->getEntityManager();
        $this->expenseRepository = $this->entityManager->getRepository(Expense::class);
    }

    public function processRequest()
    {
        $id = filter_input(
            INPUT_POST,
            'id',
            FILTER_VALIDATE_INT
        );

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

        if (is_null($id) || $id === false) {
            throw new Exception('ID está vazio ou null!');
        }

        $expense = $this->expenseRepository->find($id);
        $expense->setDescription($description);
        $expense->setAmount($amount);
        $expense->setDate($date);
        $this->entityManager->persist($expense);
        $this->entityManager->flush();
    }
}
