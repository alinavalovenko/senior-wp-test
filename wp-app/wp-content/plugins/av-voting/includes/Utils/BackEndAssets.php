<?php

namespace AvVoting\Utils;

class BackEndAssets extends AssetsAbstract
{
    public function styles()
    {
        wp_enqueue_style(
            'av-voting-admin',
            AVV_PLUGIN_ASSETS . 'css/backend.css',
            [],
            AVV_PLUGIN_VERSION
        );
    }

    public function scripts()
    {
        wp_enqueue_script(
            'av-voting-admin',
            AVV_PLUGIN_ASSETS . 'js/backend.js',
            ['jquery'],
            AVV_PLUGIN_VERSION
        );
    }
}