<?php
/**
 * Plugin Name: Was this article helpful?
 * Description: Plugin to let your visitors vote for an article
 * Version:     1.0.0
 * Author: Alina Valovenko
 * Author URI: https://github.com/alinavalovenko
 * License: GPL-3.0+
 * Text Domain: av-voting
 * Requires PHP: 8.0.28
 */

use AvVoting\Filters\ContentFilters;
use AvVoting\Utils\BackEndAssets;
use AvVoting\Utils\FrontEndAssets;

$composer_path = __DIR__ . '/vendor/autoload.php';
clearstatcache();
if (file_exists($composer_path)) {
    require_once($composer_path);
} else {
    deactivate_plugins(plugin_basename(__FILE__));
    wp_die(__('Vendors not found. Can\'t include ' . $composer_path, 'av-voting'));
}

if (!defined('AVV_PLUGIN_VERSION')) {
    define('AVV_PLUGIN_VERSION', '1.0.0');
}

if (!defined('AVV_PLUGIN_DIR')) {
    define('AVV_PLUGIN_DIR', plugin_dir_path(__FILE__));
}

if (!defined('AVV_PLUGIN_URL')) {
    define('AVV_PLUGIN_URL', plugin_dir_url(__FILE__));
}

if (!defined('AVV_PLUGIN_ASSETS')) {
    define('AVV_PLUGIN_ASSETS', AVV_PLUGIN_URL . '/assets/dist/');
}
if (!defined('AVV_PLUGIN_VIEW_DIR')) {
    define('AVV_PLUGIN_VIEW_DIR', AVV_PLUGIN_DIR . 'views/');
}

if (!defined('AVV_VOTES_POSITIVE_META_KEY')) {
    define('AVV_VOTES_POSITIVE_META_KEY', 'avv_positive');
}

if (!defined('AVV_VOTES_NEGATIVE_META_KEY')) {
    define('AVV_VOTES_NEGATIVE_META_KEY', 'avv_negative');
}

class AvVoting
{
    public function __invoke()
    {
        $this->registerAssets();
        $this->filters();
    }

    private function registerAssets()
    {
        add_action('admin_enqueue_scripts', new BackEndAssets());
        add_action('wp_enqueue_scripts', new FrontEndAssets());
    }

    private function filters()
    {
        add_action('wp', new ContentFilters());
    }
}

add_action('init', new AvVoting());
