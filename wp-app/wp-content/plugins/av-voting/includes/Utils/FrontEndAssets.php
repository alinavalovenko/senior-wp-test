<?php

namespace AvVoting\Utils;

class FrontEndAssets extends AssetsAbstract
{
    public function styles()
    {
        wp_enqueue_style(
            'av-voting',
            AVV_PLUGIN_ASSETS . 'css/styles.css',
            [],
            AVV_PLUGIN_VERSION
        );
    }

    public function scripts()
    {
        wp_enqueue_script(
            'av-voting',
            AVV_PLUGIN_ASSETS . 'js/scripts.js',
            ['jquery'],
            AVV_PLUGIN_VERSION
        );
    }
}