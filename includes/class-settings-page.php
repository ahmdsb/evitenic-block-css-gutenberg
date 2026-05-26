<?php

defined('ABSPATH') || exit;

final class Evitenic_Block_CSS_Settings_Page
{
    public function __construct()
    {
        add_action(
            'admin_menu',
            [$this, 'menu']
        );

        add_action(
            'admin_init',
            [$this, 'maybe_reset']
        );
    }

    public function menu(): void
    {
        add_options_page(
            'Evitenic Block CSS',
            'Evitenic Block CSS',
            'manage_options',
            'evitenic-block-css',
            [$this, 'render']
        );
    }

    public function maybe_reset(): void
    {
        if (!current_user_can('manage_options')) {
            return;
        }

        if (
            empty($_POST['evitenic_reset_breakpoints'])
        ) {
            return;
        }

        check_admin_referer(
            'evitenic_block_css_group-options'
        );

        update_option(
            Evitenic_Block_CSS_Breakpoints::OPTION_NAME,
            Evitenic_Block_CSS_Breakpoints::defaults()
        );

        set_transient(
            'evitenic_block_css_reset_notice',
            true,
            30
        );

        wp_safe_redirect(
            add_query_arg(
                [
                    'page' => 'evitenic-block-css',
                ],
                admin_url('options-general.php')
            )
        );

        exit;
    }

    public function render(): void
    {
        if (!current_user_can('manage_options')) {
            return;
        }

        $breakpoints =
            Evitenic_Block_CSS_Breakpoints::get_all();

?>

        <div class="wrap evitenic-admin-wrap">

            <h1>
                Evitenic Block CSS
            </h1>

            <p>
                Manage responsive breakpoint presets here.
            </p>

            <?php if (
                get_transient(
                    'evitenic_block_css_reset_notice'
                )
            ) : ?>

                <?php delete_transient(
                    'evitenic_block_css_reset_notice'
                ); ?>

                <div class="notice notice-success is-dismissible">
                    <p>
                        Breakpoints reset successfully.
                    </p>
                </div>

            <?php endif; ?>

            <form
                method="post"
                action="options.php">

                <?php settings_fields(
                    'evitenic_block_css_group'
                ); ?>

                <div
                    id="evitenic-breakpoints-list"
                    class="evitenic-breakpoints-list">

                    <?php foreach (
                        $breakpoints as $index => $bp
                    ) : ?>

                        <?php
                        Evitenic_Block_CSS_Settings_Fields::breakpoint_row(
                            $index,
                            $bp
                        );
                        ?>

                    <?php endforeach; ?>

                </div>

                <p>
                    <button
                        type="button"
                        class="button button-primary"
                        id="evitenic-add-breakpoint">
                        Add Breakpoint
                    </button>
                </p>

                <div class="evitenic-form-actions">

                    <?php submit_button(
                        'Save Changes',
                        'primary',
                        'submit',
                        false
                    ); ?>

                    <button
                        type="submit"
                        class="button"
                        name="evitenic_reset_breakpoints"
                        value="1">
                        Reset Default
                    </button>

                </div>
            </form>

            <template id="evitenic-breakpoint-template">

                <?php
                Evitenic_Block_CSS_Settings_Fields::breakpoint_row(
                    '__INDEX__',
                    [
                        'id' => '',
                        'label' => '',
                        'type' => 'max',
                        'value' => '',
                    ]
                );
                ?>

            </template>

        </div>

<?php
    }
}
