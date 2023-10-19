<?php
/**
 * Register Rest Route Interface
 */

namespace AvVoting\Routes;

interface RegisterRestRoutesInterface
{
    /**
     * Get uniq part for the rest route
     * @return string
     */
    public function getName(): string;

    /**
     * Get a common part of the route
     * @return string
     */
    public function getRoute(): string;

    /**
     * Route arguments
     * @return array
     */
    public function getArguments(): array;
}
