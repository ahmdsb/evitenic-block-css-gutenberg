<?php

defined('ABSPATH') || exit;

final class Evitenic_Block_CSS_Settings_Fields
{
    public static function breakpoint_row(
        $index,
        array $bp
    ): void {

        $id = (string)
        evitenic_block_css_array_get(
            $bp,
            'id'
        );

        $label = (string)
        evitenic_block_css_array_get(
            $bp,
            'label'
        );

        $type = (string)
        evitenic_block_css_array_get(
            $bp,
            'type',
            'max'
        );

        $value =
            evitenic_block_css_array_get(
                $bp,
                'value'
            );

?>

        <div class="evitenic-breakpoint-row">

            <div class="evitenic-breakpoint-card">

                <div class="evitenic-breakpoint-fields">

                    <p>
                        <label>ID</label>

                        <input
                            data-name="id"
                            type="text"
                            class="regular-text"
                            value="<?php echo esc_attr($id); ?>"
                            placeholder="mobile">
                    </p>

                    <p>
                        <label>Label</label>

                        <input
                            data-name="label"
                            type="text"
                            class="regular-text"
                            value="<?php echo esc_attr($label); ?>"
                            placeholder="Mobile">
                    </p>

                    <p>
                        <label>Type</label>

                        <select data-name="type">

                            <option
                                value="base"
                                <?php selected($type, 'base'); ?>>
                                Base
                            </option>

                            <option
                                value="max"
                                <?php selected($type, 'max'); ?>>
                                Max Width
                            </option>

                            <option
                                value="min"
                                <?php selected($type, 'min'); ?>>
                                Min Width
                            </option>

                        </select>
                    </p>

                    <p>
                        <label>Value</label>

                        <input
                            data-name="value"
                            type="number"
                            min="0"
                            step="1"
                            value="<?php echo esc_attr($value); ?>"
                            placeholder="768">
                    </p>

                </div>

                <div class="evitenic-breakpoint-actions">

                    <button
                        type="button"
                        class="button evitenic-move-up">
                        Up
                    </button>

                    <button
                        type="button"
                        class="button evitenic-move-down">
                        Down
                    </button>

                    <button
                        type="button"
                        class="button button-link-delete evitenic-remove-row">
                        Remove
                    </button>

                </div>

            </div>

        </div>

<?php
    }
}
