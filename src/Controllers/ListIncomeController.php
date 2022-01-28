<?php

namespace FinanceApp\Controllers;

use Doctrine\ORM\EntityRepository;
use FinanceApp\Controllers\Interface\BaseController;
use FinanceApp\Infra\EntityManagerCreator;
use FinanceApp\Models\Income;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ListIncomeController implements RequestHandlerInterface
{
    private EntityRepository $incomeRepository;

    public function __construct()
    {
        $entityManager = (new EntityManagerCreator())->getEntityManager();
        $this->incomeRepository = $entityManager->getRepository(Income::class);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        if (isset($request->getQueryParams()['descricao'])) {
            $description = filter_input(
                INPUT_GET,
                'descricao',
                FILTER_SANITIZE_STRING
            );

            $income = $this->incomeRepository->findOneBy([
                'description' => $description
            ]);

            return new Response(200, [], $this->serialize($income));
        }

        $incomes = $this->incomeRepository->findAll();
        return new Response(200, [], $this->serialize($incomes));
    }

    protected function serialize($result): bool|string
    {
        return json_encode($result);
    }
}
