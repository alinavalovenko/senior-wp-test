<?php
/**
 * Ajax handler to save voting results for post
 */

namespace AvVoting\Handlers;

class SaveVoteHandler
{
    public function __invoke()
    {
        if (!wp_verify_nonce($_POST['nonce'], 'formnonce')) {
            wp_send_json([], 403);
        }

        if (empty($_POST['id'])) {
            wp_send_json(['error' => 'Post id is mandatory'], 400);
        }

        if (!isset($_POST['value'])) {
            wp_send_json(['error' => 'Vote value is mandatory'], 400);
        }
        $id = $_POST['id'];
        $vote = $_POST['value'];
        $positive = get_post_meta($id, AVV_VOTES_POSITIVE_META_KEY, true) ?: 0;
        $negative = get_post_meta($id, AVV_VOTES_NEGATIVE_META_KEY, true) ?: 0;

        if (intval($vote) > 0) {
            $positive++;
            update_post_meta($id, AVV_VOTES_POSITIVE_META_KEY, $positive);
        } else {
            $negative++;
            update_post_meta($id, AVV_VOTES_NEGATIVE_META_KEY, $negative);
        }
        $positive = round(($positive / ($positive + $negative)) * 100);
        $negative = 100 - $positive;

        ob_start();

        include AVV_PLUGIN_VIEW_DIR . 'voting-stat.php';
        $response = [
            'success' => 1,
            'html' => ob_get_clean()
        ];

        wp_send_json($response, 200);
    }

    public function handle()
    {

    }
}