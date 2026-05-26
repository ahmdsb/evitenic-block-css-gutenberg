<?php

defined('ABSPATH') || exit;

final class Evitenic_Block_CSS_Settings
{
    public function __construct()
    {
        add_action(
            'admin_init',
            [$this, 'register']
        );
    }

    public function register(): void
    {
        register_setting(
            'evitenic_block_css_group',
            Evitenic_Block_CSS_Breakpoints::OPTION_NAME,
            [
                'type' => 'array',

                'sanitize_callback' => [
                    Evitenic_Block_CSS_Breakpoints::class,
                    'sanitize',
                ],

                'default' => Evitenic_Block_CSS_Breakpoints::defaults(),
            ]
        );
    }
}
