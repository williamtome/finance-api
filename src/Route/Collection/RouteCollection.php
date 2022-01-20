<?php

namespace FinanceApp\Route\Collection;

class RouteCollection
{
    protected array $routesPost = [];
    protected array $routesGet = [];
    protected array $routesPut = [];
    protected array $routesDelete = [];

    /**
     * @throws \Exception
     */
    public function add(string $requestType, string $pattern, callable|string $callback): static
    {
        switch ($requestType) {
            case 'post':
                return $this->addPost($pattern, $callback);
            case 'get':
                return $this->addGet($pattern, $callback);
            case 'put':
                return $this->addPut($pattern, $callback);
            case 'delete':
                return $this->addDelete($pattern, $callback);
            default:
                throw new \Exception('Tipo de requisição incorreta!');
        }
    }

    /**
     * @throws \Exception
     */
    public function where(string $requestType, string $pattern)
    {
        switch ($requestType) {
            case 'post':
                return $this->findPost($pattern);
            case 'get':
                return $this->findGet($pattern);
            case 'put':
                return $this->findPut($pattern);
            case 'delete':
                return $this->findDelete($pattern);
            default:
                throw new \Exception('Tipo de requisição incorreta!');
        }
    }

    protected function parseUri($uri)
    {
        return implode('/', array_filter(explode('/', $uri)));
    }

    protected function definePattern(string $pattern): string
    {
        $pattern = implode('/', array_filter(explode('/', $pattern)));
        return '/^' . str_replace('/', '\/', $pattern) . '$/';
    }

    protected function addPost(string $pattern, callable $callback)
    {
        $this->routesPost[$this->definePattern($pattern)] = $callback;

        return $this;
    }

    protected function addGet(string $pattern, callable $callback)
    {
        $this->routesGet[$this->definePattern($pattern)] = $callback;

        return $this;
    }

    protected function addPut(string $pattern, callable $callback)
    {
        $this->routesPut[$this->definePattern($pattern)] = $callback;

        return $this;
    }

    protected function addDelete(string $pattern, callable $callback)
    {
        $this->routesDelete[$this->definePattern($pattern)] = $callback;

        return $this;
    }

    /**
     * @param string $patternSent
     * @return false|object|void
     */
    protected function findPost(string $patternSent)
    {
        $patternSent = $this->parseUri($patternSent);

        foreach ($this->routesPost as $pattern => $callback) {
            if (preg_match($pattern, $patternSent, $pieces)) {
                return (object) [
                    'callback' => $callback,
                    'uri' => $pieces,
                ];
            }

            return false;
        }
    }

    protected function findGet(string $patternSent)
    {
        $patternSent = $this->parseUri($patternSent);

        foreach ($this->routesGet as $pattern => $callback) {
            if (preg_match($pattern, $patternSent, $pieces)) {
                return (object) [
                    'callback' => $callback,
                    'uri' => $pieces,
                ];
            }

            return false;
        }
    }

    protected function findPut(string $patternSent)
    {
        $patternSent = $this->parseUri($patternSent);

        foreach ($this->routesPut as $pattern => $callback) {
            if (preg_match($pattern, $patternSent, $pieces)) {
                return (object) [
                    'callback' => $callback,
                    'uri' => $pieces,
                ];
            }

            return false;
        }
    }

    protected function findDelete(string $patternSent)
    {
        $patternSent = $this->parseUri($patternSent);

        foreach ($this->routesDelete as $pattern => $callback) {
            if (preg_match($pattern, $patternSent, $pieces)) {
                return (object) [
                    'callback' => $callback,
                    'uri' => $pieces,
                ];
            }

            return false;
        }
    }
}
