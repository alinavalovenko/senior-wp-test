<?php

namespace AvVoting\Filters;

class ContentFilters
{
    private string $content;

    public function __invoke()
    {
        add_filter('the_content', [$this, 'appendVotingHolder']);
    }

    public function appendVotingHolder(string $content): string
    {
        return $content . '<div class="av-voting-wrap"></div>';
    }
}