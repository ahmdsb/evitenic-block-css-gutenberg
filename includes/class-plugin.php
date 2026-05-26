<?php

defined('ABSPATH') || exit;

final class Evitenic_Block_CSS_Plugin
{
    public function __construct()
    {
        $this->load_files();
        $this->boot();
    }


    private function load_files(): void
    {
        require_once
            EVITENIC_BLOCK_CSS_PATH .
            'includes/class-assets.php';

        require_once
            EVITENIC_BLOCK_CSS_PATH .
            'includes/class-breakpoints.php';

        require_once
            EVITENIC_BLOCK_CSS_PATH .
            'includes/class-settings.php';

        require_once
            EVITENIC_BLOCK_CSS_PATH .
            'includes/class-settings-page.php';

        require_once
            EVITENIC_BLOCK_CSS_PATH .
            'includes/class-settings-fields.php';

        require_once
            EVITENIC_BLOCK_CSS_PATH .
            'includes/class-css-compiler.php';

        require_once
            EVITENIC_BLOCK_CSS_PATH .
            'includes/class-post-css-generator.php';

        require_once
            EVITENIC_BLOCK_CSS_PATH .
            'includes/class-frontend-css.php';
    }

    private function boot(): void
    {
        new Evitenic_Block_CSS_Settings();

        new Evitenic_Block_CSS_Assets();

        new Evitenic_Block_CSS_Settings_Page();

        new Evitenic_Block_CSS_Settings_Fields();

        new Evitenic_Block_CSS_Post_CSS_Generator();

        new Evitenic_Block_CSS_Frontend_CSS();
    }
}
