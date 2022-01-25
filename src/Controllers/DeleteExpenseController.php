<?php

namespace FinanceApp\Controllers;

use Doctrine\ORM\EntityManagerInterface;
use Exception;
use FinanceApp\Controllers\Interface\BaseController;
use FinanceApp\Infra\EntityManagerCreator;
use FinanceApp\Models\Expense;

class DeleteExpenseController implements BaseController
{
    private EntityManagerInterface $entityManager;

    public function __construct()
    {
        $this->entityManager = (new EntityManagerCreator())
            ->getEntityManager();
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     */
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

        $income = $this->entityManager
            ->getReference(Expense::class, $id);

        $this->entityManager->remove($income);
        $this->entityManager->flush();
    }
}
