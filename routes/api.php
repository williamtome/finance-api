<?php

use FinanceApp\Controllers\ExpenseController;
use FinanceApp\Controllers\CreateIncomeController;
use FinanceApp\Controllers\ListIncomeController;

return [
    '/listar-receitas' => ListIncomeController::class,
    '/criar-receita' => CreateIncomeController::class,
    '/listar-despesas' => ExpenseController::class,
];
