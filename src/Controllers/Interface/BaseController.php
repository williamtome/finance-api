<?php

namespace FinanceApp\Controllers\Interface;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

interface BaseController
{
    public function processRequest(ServerRequestInterface $request): ResponseInterface;
}