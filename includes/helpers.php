<?php

defined('ABSPATH') || exit;

function evitenic_block_css_array_get(
    array $array,
    string $key,
    $default = null
) {
    return $array[$key] ?? $default;
}
