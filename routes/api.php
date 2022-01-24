<?php

use FinanceApp\Controllers\DeleteIncomeController;
use FinanceApp\Controllers\ExpenseController;
use FinanceApp\Controllers\CreateIncomeController;
use FinanceApp\Controllers\ListIncomeController;
use FinanceApp\Controllers\ShowIncomeController;
use FinanceApp\Controllers\UpdateIncomeController;

return [
    '/listar-receitas' => ListIncomeController::class,
    '/criar-receita' => CreateIncomeController::class,
    '/visualizar-receita' => ShowIncomeController::class,
    '/atualizar-receita' => UpdateIncomeController::class,
    '/excluir-receita' => DeleteIncomeController::class,
    '/listar-despesas' => ExpenseController::class,
];
