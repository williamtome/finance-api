<?php

namespace FinanceApp\Controllers;

use Doctrine\ORM\EntityRepository;
use FinanceApp\Controllers\Interface\BaseController;
use FinanceApp\Infra\EntityManagerCreator;
use FinanceApp\Models\Income;

class ListIncomeController implements BaseController
{
    private EntityRepository $incomeRepository;

    public function __construct()
    {
        $entityManager = (new EntityManagerCreator())->getEntityManager();
        $this->incomeRepository = $entityManager->getRepository(Income::class);
    }

    public function processRequest()
    {
        if (isset($_GET['descricao'])) {
            $description = filter_input(
                INPUT_GET,
                'descricao',
                FILTER_SANITIZE_STRING
            );

            $income = $this->incomeRepository->findOneBy([
                'description' => $description
            ]);

            $this->serialize($income);
            return;
        }

        $incomes = $this->incomeRepository->findAll();
        print_r($this->serialize($incomes));
    }

    protected function serialize($result)
    {
        return json_encode($result);
    }
}
