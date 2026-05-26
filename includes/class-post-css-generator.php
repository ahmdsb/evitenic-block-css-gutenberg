<?php

defined('ABSPATH') || exit;

final class Evitenic_Block_CSS_Post_CSS_Generator
{
    public function __construct()
    {
        add_action(
            'save_post',
            [$this, 'generate'],
            20,
            2
        );

        add_action(
            'before_delete_post',
            [$this, 'delete']
        );
    }

    public function generate(
        int $post_id,
        WP_Post $post
    ): void {

        if (
            wp_is_post_revision($post_id)
            || wp_is_post_autosave($post_id)
        ) {
            return;
        }

        $css =
            Evitenic_Block_CSS_Compiler::build_from_content(
                $post->post_content
            );

        $upload = wp_upload_dir();

        $dir =
            trailingslashit(
                $upload['basedir']
            ) . 'evitenic-block-css';

        wp_mkdir_p($dir);

        $file =
            trailingslashit($dir) .
            'post-' . $post_id . '.css';

        if (!$css) {

            if (file_exists($file)) {
                unlink($file);
            }

            return;
        }

        file_put_contents(
            $file,
            trim($css),
            LOCK_EX
        );
    }

    public function delete(
        int $post_id
    ): void {

        $upload =
            wp_upload_dir();

        $file =
            trailingslashit(
                $upload['basedir']
            ) .
            'evitenic-block-css/post-' .
            $post_id .
            '.css';

        if (
            file_exists($file)
        ) {

            unlink($file);
        }
    }
}
