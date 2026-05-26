<?php

/**
 * Plugin Name: Evitenic Block CSS Gutenberg
 * Description: Scoped responsive CSS editor for Gutenberg blocks.
 * Version: 1.0.0
 * Author: Evitenic
 */

defined('ABSPATH') || exit;

define('EVITENIC_BLOCK_CSS_VERSION', '0.2.0');

define(
    'EVITENIC_BLOCK_CSS_PATH',
    plugin_dir_path(__FILE__)
);

define(
    'EVITENIC_BLOCK_CSS_URL',
    plugin_dir_url(__FILE__)
);

require_once EVITENIC_BLOCK_CSS_PATH . 'includes/helpers.php';

require_once EVITENIC_BLOCK_CSS_PATH . 'includes/class-plugin.php';

new Evitenic_Block_CSS_Plugin();
