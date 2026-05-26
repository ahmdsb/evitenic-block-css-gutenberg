<?php

defined('ABSPATH') || exit;

final class Evitenic_Block_CSS_Assets
{
    public function __construct()
    {
        add_action(
            'enqueue_block_editor_assets',
            [$this, 'editor']
        );

        add_action(
            'enqueue_block_editor_assets',
            [$this, 'editor_post_css'],
            99
        );

        add_action(
            'admin_enqueue_scripts',
            [$this, 'admin']
        );
    }

    public function editor(): void
    {
        wp_enqueue_script(
            'evitenic-block-css-editor',
            EVITENIC_BLOCK_CSS_URL . 'build/index.js',
            [
                'wp-hooks',
                'wp-element',
                'wp-components',
                'wp-compose',
                'wp-data',
                'wp-block-editor',
            ],
            '0.3.0',
            true
        );

        wp_enqueue_style(
            'evitenic-block-css-editor',
            EVITENIC_BLOCK_CSS_URL . 'build/style-index.css',
            [],
            '0.3.0'
        );

        wp_localize_script(
            'evitenic-block-css-editor',
            'EvitenicBlockCSSData',
            [
                'breakpoints' =>
                Evitenic_Block_CSS_Breakpoints::get_all(),
            ]
        );
    }

    public function admin(string $hook): void
    {
        error_log($hook);

        if (
            $hook !==
            'settings_page_evitenic-block-css'
        ) {
            return;
        }

        wp_enqueue_style(
            'evitenic-block-css-admin',

            EVITENIC_BLOCK_CSS_URL .
                'admin-build/style-index.css',

            [],

            EVITENIC_BLOCK_CSS_VERSION
        );

        wp_enqueue_script(
            'evitenic-block-script-admin',

            EVITENIC_BLOCK_CSS_URL .
                'admin-build/index.js',

            [],

            EVITENIC_BLOCK_CSS_VERSION,

            true
        );
    }

    public function editor_post_css(): void
    {
        global $post;

        if (!$post) {
            return;
        }

        $upload =
            wp_upload_dir();

        $base_dir =
            trailingslashit(
                $upload['basedir']
            ) .
            'evitenic-block-css';

        $base_url =
            trailingslashit(
                $upload['baseurl']
            ) .
            'evitenic-block-css';

        $file =
            $base_dir .
            '/post-' .
            $post->ID .
            '.css';

        if (!file_exists($file)) {
            return;
        }

        wp_enqueue_style(
            'evitenic-block-css-editor-' .
                $post->ID,

            $base_url .
                '/post-' .
                $post->ID .
                '.css',

            [],

            filemtime($file)
        );
    }
}
