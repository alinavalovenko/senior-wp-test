<?php

namespace AvVoting\Routes;

use AvVoting\Handlers\GetStatViewHandler;

class GetStatViewRoute implements RegisterRestRoutesInterface
{
    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return '/get-stat';
    }

    /**
     * @inheritDoc
     */
    public function getRoute(): string
    {
        return 'av-voting/v1';
    }

    /**
     * @inheritDoc
     */
    public function getArguments(): array
    {
        $handler = new GetStatViewHandler();
        return [
            [
                'methods' => 'GET',
                'callback' => [$handler, 'handle'],
                'args' => [],
                'permission_callback' => '__return_true',
            ]
        ];
    }
}