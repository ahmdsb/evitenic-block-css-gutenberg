<?php

defined('ABSPATH') || exit;

final class Evitenic_Block_CSS_Breakpoints
{
    const OPTION_NAME = 'evitenic_block_css_breakpoints';

    public static function defaults(): array
    {
        return [
            [
                'id' => 'desktop',
                'label' => 'Desktop',
                'type' => 'base',
                'value' => null,
            ],
            [
                'id' => 'tablet',
                'label' => 'Tablet',
                'type' => 'max',
                'value' => 781,
            ],
            [
                'id' => 'mobile',
                'label' => 'Mobile',
                'type' => 'max',
                'value' => 479,
            ],
        ];
    }

    public static function get_all(): array
    {
        $stored = get_option(
            self::OPTION_NAME,
            self::defaults()
        );

        if (!is_array($stored) || !$stored) {
            return self::defaults();
        }

        return self::sanitize($stored);
    }

    public static function sanitize($value): array
    {
        if (!is_array($value)) {
            return self::defaults();
        }

        $clean = [];

        foreach ($value as $item) {

            if (!is_array($item)) {
                continue;
            }

            $id = sanitize_key(
                (string) evitenic_block_css_array_get($item, 'id')
            );

            if (!$id) {
                continue;
            }

            $label = sanitize_text_field(
                (string) evitenic_block_css_array_get(
                    $item,
                    'label',
                    ucfirst($id)
                )
            );

            $type = (string) evitenic_block_css_array_get(
                $item,
                'type',
                'max'
            );

            if (!in_array($type, ['base', 'max', 'min'], true)) {
                $type = 'max';
            }

            $raw_value = evitenic_block_css_array_get(
                $item,
                'value'
            );

            $value_num = (
                $raw_value === ''
                || $raw_value === null
            )
                ? null
                : absint($raw_value);

            $clean[] = [
                'id' => $id,
                'label' => $label,
                'type' => $type,
                'value' => $value_num,
            ];
        }

        return $clean ?: self::defaults();
    }

    public static function find(
        string $breakpoint_id
    ): ?array {

        foreach (self::get_all() as $breakpoint) {

            if (
                evitenic_block_css_array_get(
                    $breakpoint,
                    'id'
                ) === $breakpoint_id
            ) {
                return $breakpoint;
            }
        }

        return null;
    }
}
