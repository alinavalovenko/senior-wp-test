<?php
/**
 * Register custom REST Api routes
 */

namespace AvVoting\Routes;

class Routes
{
    public function __invoke()
    {
        $routes = [new GetFormViewRoute(), new GetStatViewRoute()];

        foreach ($routes as $route) {
            register_rest_route(
                $route->getRoute(),
                $route->getName(),
                $route->getArguments(),
            );
        }
    }
}