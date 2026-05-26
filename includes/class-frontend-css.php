<?php

defined('ABSPATH') || exit;

final class Evitenic_Block_CSS_Frontend_CSS
{
    public function __construct()
    {
        add_action(
            'wp_enqueue_scripts',
            [$this, 'enqueue'],
            99
        );
    }

    public function enqueue(): void
    {
        if (!is_singular()) {
            return;
        }

        $post_id =
            get_queried_object_id();

        if (!$post_id) {
            return;
        }

        $upload =
            wp_upload_dir();

        $base_dir =
            trailingslashit(
                $upload['basedir']
            ) . 'evitenic-block-css';

        $base_url =
            trailingslashit(
                $upload['baseurl']
            ) . 'evitenic-block-css';

        $file =
            $base_dir .
            '/post-' .
            $post_id .
            '.css';

        if (!file_exists($file)) {
            return;
        }

        wp_enqueue_style(
            'evitenic-block-css-' . $post_id,
            $base_url .
            '/post-' .
            $post_id .
            '.css',
            [],
            filemtime($file)
        );
    }
}
