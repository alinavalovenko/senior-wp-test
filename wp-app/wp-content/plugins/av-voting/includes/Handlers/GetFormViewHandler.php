<?php

namespace AvVoting\Handlers;

use WP_REST_Request;

class GetFormViewHandler implements HandleRequestInterface
{
    public function handle(WP_REST_Request $request)
    {
        ob_start();
        include AVV_PLUGIN_VIEW_DIR . 'voting-form.php';

        return [
            'success' => 1,
            'html' => ob_get_clean()
        ];
    }
}