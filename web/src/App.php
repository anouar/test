<?php

declare(strict_types=1);

namespace App;

class App
{
    public function __construct(
        protected Container $container,
        protected Router $router,
        protected array $request,
    ) {
    }

    public function run()
    {
        try {
            echo $this->router->resolve($this->request['uri'], strtolower($this->request['method']));
        } catch (\Exception $e) {
        }
    }
}
