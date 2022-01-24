<?php

namespace FinanceApp\Controllers;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ObjectRepository;
use FinanceApp\Controllers\Interface\BaseController;
use FinanceApp\Infra\EntityManagerCreator;
use FinanceApp\Models\Income;
use \Exception;

class ShowIncomeController implements BaseController
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
            INPUT_GET,
            'id',
            FILTER_VALIDATE_INT
        );

        if (is_null($id) || $id === false) {
            throw new Exception('ID está vazio ou null!');
        }

        $income = $this->incomeRepository->find($id);
        print_r($this->serialize($income));
    }

    protected function serialize($result)
    {
        return json_encode($result);
    }
}