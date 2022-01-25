<?php

use FinanceApp\Controllers\{
    CreateExpenseController,
    CreateIncomeController,
    DeleteExpenseController,
    DeleteIncomeController,
    ListExpenseController,
    ListIncomeController,
    ShowExpenseController,
    ShowIncomeController,
    UpdateExpenseController,
    UpdateIncomeController
};

return [
    '/listar-receitas' => ListIncomeController::class,
    '/criar-receita' => CreateIncomeController::class,
    '/visualizar-receita' => ShowIncomeController::class,
    '/atualizar-receita' => UpdateIncomeController::class,
    '/excluir-receita' => DeleteIncomeController::class,
    '/listar-despesas' => ListExpenseController::class,
    '/criar-despesa' => CreateExpenseController::class,
    '/visualizar-despesa' => ShowExpenseController::class,
    '/atualizar-despesa' => UpdateExpenseController::class,
    '/excluir-despesa' => DeleteExpenseController::class,
];
