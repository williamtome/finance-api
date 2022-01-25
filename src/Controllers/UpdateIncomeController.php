<?php

namespace FinanceApp\Controllers;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ObjectRepository;
use Exception;
use FinanceApp\Controllers\Interface\BaseController;
use FinanceApp\Infra\EntityManagerCreator;
use FinanceApp\Models\Income;

class UpdateIncomeController implements BaseController
{
    private EntityManagerInterface $entityManager;
    private ObjectRepository|EntityRepository $incomeRepository;

    public function __construct()
    {
        $this->entityManager = (new EntityManagerCreator())->getEntityManager();
        $this->incomeRepository = $this->entityManager->getRepository(Income::class);
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

        $income = $this->incomeRepository->find($id);
        $income->setDescription($description);
        $income->setAmount($amount);
        $income->setDate($date);
        $this->entityManager->persist($income);
        $this->entityManager->flush();
    }
}
