<?php

namespace AvVoting\Admin;

class MetaBox
{
    public function __invoke()
    {
        add_action('add_meta_boxes', [$this, 'addMetaBoxField']);
        add_action('save_post', [$this, 'saveMetaBoxField']);
    }

    public function addMetaBoxField()
    {
        add_meta_box('av_positive', 'Positive Votes', [$this, 'displayMetaBoxPositiveField'], 'post', 'side', 'high');
        add_meta_box('av_negative', 'Negative Votes', [$this, 'displayMetaBoxNegativeField'], 'post', 'side', 'high');
    }

    public function displayMetaBoxPositiveField($post)
    {
        $value = get_post_meta($post->ID, AVV_VOTES_POSITIVE_META_KEY, true);
        ?>
        <input type="number"  min="0" step="1" name="av_positive" value="<?php echo esc_attr($value); ?>">
        <?php
    }

    public function displayMetaBoxNegativeField($post)
    {
        $value = get_post_meta($post->ID, AVV_VOTES_NEGATIVE_META_KEY, true);
        ?>
        <input type="number" min="0" step="1" name="av_negative" value="<?php echo esc_attr($value); ?>">
        <?php
    }

    public function saveMetaBoxField($post_id)
    {
        if (array_key_exists('av_positive', $_POST)) {
            update_post_meta($post_id, AVV_VOTES_POSITIVE_META_KEY, round($_POST['av_positive']));
        }

        if (array_key_exists('av_negative', $_POST)) {
            update_post_meta($post_id, AVV_VOTES_NEGATIVE_META_KEY, round($_POST['av_negative']));
        }
    }
}