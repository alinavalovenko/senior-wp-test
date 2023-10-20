<?php

namespace AvVoting\Routes;

use AvVoting\Handlers\GetFormViewHandler;

class GetFormViewRoute implements RegisterRestRoutesInterface
{
    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return '/get-form';
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
        $handler = new GetFormViewHandler();
        return [
            [
                'methods'             => 'GET',
                'callback'            => [$handler, 'handle'],
                'args'                => [],
                'permission_callback' => '__return_true',
            ]
        ];
    }
}