<?php

namespace FinanceApp\Controllers;

use Doctrine\ORM\EntityManagerInterface;
use FinanceApp\Controllers\Interface\BaseController;
use FinanceApp\Infra\EntityManagerCreator;
use FinanceApp\Models\Income;

class DeleteIncomeController implements BaseController
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
            header('Location: /listar-receitas');
            return;
        }

        $income = $this->entityManager
            ->getReference(Income::class, $id);

        $this->entityManager->remove($income);
        $this->entityManager->flush();
    }
}
