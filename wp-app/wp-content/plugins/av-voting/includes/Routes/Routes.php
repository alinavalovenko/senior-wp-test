<?php

namespace AvVoting\Routes;

class Routes
{
    public function __invoke()
    {
        $route = new GetViewRoute();

        register_rest_route(
            $route->getRoute(),
            $route->getName(),
            $route->getArguments(),
        );
    }
}