<?php
/**
 * Rest API handler to fetch statistics for post
 */

namespace AvVoting\Handlers;

use WP;
use WP_REST_Request;

class GetStatViewHandler implements HandleRequestInterface
{
    public function handle(WP_REST_Request $request)
    {
        if (!isset($_GET['id'])) {
            return [
                'success' => 0,
                'html' => ''
            ];
        }
        $id = intval($_GET['id']);

        // fetch data stored in the database
        $positive = get_post_meta($id, AVV_VOTES_POSITIVE_META_KEY, true) ?: 0;
        $negative = get_post_meta($id, AVV_VOTES_NEGATIVE_META_KEY, true) ?: 0;

        $totalVotes = $positive + $negative;

        if ($totalVotes > 0) {
            $positive = round(($positive / $totalVotes) * 100);
            $negative = 100 - $positive;
        }

        ob_start();

        include AVV_PLUGIN_VIEW_DIR . 'voting-stat.php';

        return [
            'success' => 1,
            'html' => ob_get_clean()
        ];
    }
}