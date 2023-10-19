<?php
/**
 * Interface which describes base implementation of request handler
 */

namespace AvVoting\Handlers;

use WP_REST_Request;

interface HandleRequestInterface
{
    /**
     * Method should be used as a callback function on REST API request
     *
     * @param WP_REST_Request $request
     *
     * @return mixed
     */
    public function handle(WP_REST_Request $request);
}