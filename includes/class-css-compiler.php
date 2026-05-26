<?php

defined('ABSPATH') || exit;

final class Evitenic_Block_CSS_Compiler
{
    public static function build_from_content(
        string $content
    ): string {

        $blocks = parse_blocks($content);

        if (!$blocks) {
            return '';
        }

        return self::walk($blocks);
    }

    private static function walk(
        array $blocks
    ): string {

        $css = '';

        foreach ($blocks as $block) {

            $attrs =
                $block['attrs'] ?? [];

            $css_id =
                sanitize_html_class(
                    (string)
                    ($attrs['evitenicCssId'] ?? '')
                );

            $styles =
                $attrs['evitenicBlockCSS']
                ?? [];

            if (
                $css_id &&
                is_array($styles)
            ) {

                foreach (
                    $styles as $breakpoint_id => $style
                ) {

                    $style = trim((string) $style);

                    if (!$style) {
                        continue;
                    }

                    $breakpoint =
                        Evitenic_Block_CSS_Breakpoints::find(
                            (string) $breakpoint_id
                        );

                    if (!$breakpoint) {
                        continue;
                    }

                    $css .= self::compile(
                        $style,
                        'evitenic-css-' . $css_id,
                        $breakpoint
                    );
                }
            }

            if (!empty($block['innerBlocks'])) {

                $css .= self::walk(
                    $block['innerBlocks']
                );
            }
        }

        return $css;
    }

    public static function compile(
        string $css,
        string $wrapper_class,
        array $breakpoint
    ): string {

        $css = str_replace(
            'selector',
            '.' . $wrapper_class,
            $css
        );

        if (
            ($breakpoint['type'] ?? 'base')
            === 'base'
        ) {
            return $css . "\n";
        }

        return sprintf(
            '@media (%s-width: %dpx) {%s}',
            $breakpoint['type'],
            $breakpoint['value'],
            $css
        ) . "\n";
    }

    private static function minify(
        string $css
    ): string {

        $css = preg_replace(
            '/\\s+/',
            ' ',
            $css
        );

        $css = str_replace(
            [' {', '{ '],
            '{',
            $css
        );

        $css = str_replace(
            [' }', '} '],
            '}',
            $css
        );

        return trim($css);
    }
}
