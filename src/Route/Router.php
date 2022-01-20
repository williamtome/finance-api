<?php

namespace FinanceApp\Route;

use FinanceApp\Route\Collection\RouteCollection;
use JetBrains\PhpStorm\Pure;

class Router
{
    protected RouteCollection $routeCollection;

    #[Pure] public function __construct()
    {
        $this->routeCollection = new RouteCollection();
        $this->dispacher = new Dispacher;
    }

    public function post(string $pattern, callable|string $callback): static
    {
        $this->routeCollection->add('post', $pattern, $callback);

        return $this;
    }

    public function get(string $pattern, callable|string $callback): static
    {
        $this->routeCollection->add('get', $pattern, $callback);

        return $this;
    }

    public function put(string $pattern, callable|string $callback): static
    {
        $this->routeCollection->add('put', $pattern, $callback);

        return $this;
    }

    public function delete(string $pattern, callable|string $callback): static
    {
        $this->routeCollection->add('delete', $pattern, $callback);

        return $this;
    }

    public function find(string $requestType, string $pattern)
    {
        return $this->routeCollection->where($requestType, $pattern);
    }
}