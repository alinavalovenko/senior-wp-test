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
        global $post;
        return $content . '<div class="av-voting-wrap" data-post-id="' . $post->ID . '"></div>';
    }
}