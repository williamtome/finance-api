<?php

namespace FinanceApp\Controller;

use Doctrine\ORM\EntityRepository;
use FinanceApp\Infra\EntityManagerCreator;
use FinanceApp\Models\Income;

class IncomeController implements BaseController
{
    private EntityRepository $incomeRepository;

    public function __construct()
    {
        $entityManager = (new EntityManagerCreator())->getEntityManager();
        $this->incomeRepository = $entityManager->getRepository(Income::class);
    }

    public function processRequest()
    {
        $data = $this->incomeRepository->findAll();
        return json_encode(['data' => $data]);
    }
}