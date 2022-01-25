<?php

namespace FinanceApp\Controllers;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ObjectRepository;
use FinanceApp\Controllers\Interface\BaseController;
use FinanceApp\Infra\EntityManagerCreator;
use FinanceApp\Models\Expense;
use \Exception;

class ShowExpenseController implements BaseController
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
            INPUT_GET,
            'id',
            FILTER_VALIDATE_INT
        );

        if (is_null($id) || $id === false) {
            throw new Exception('ID está vazio ou null!');
        }

        $expense = $this->expenseRepository->find($id);
        print_r($this->serialize($expense));
    }

    protected function serialize($result): bool|string
    {
        return json_encode($result);
    }
}
