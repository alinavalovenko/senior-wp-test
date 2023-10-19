<?php

namespace AvVoting\Routes;

use AvVoting\Handlers\GetViewHandler;

class GetViewRoute implements RegisterRestRoutesInterface
{
    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return '/get-view';
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
        $handler = new GetViewHandler();
        return [
            [
                'methods'             => 'GET',
                'callback'            => [$handler, 'handle'],
                'args'                => [],
                'permission_callback' => function () {
                    return current_user_can( 'edit_others_posts' );
                }
            ]
        ];
    }
}