<?php
// Gleiche Tailwind-Dateien wie im regulären Seitenheader, ohne Navigation.
$stylesheet = option('debug', false)
    ? 'assets/css/twkgs_shrinked.css'
    : 'assets/css/twkgs_shrinked.min.css';
$path = kirby()->root('index') . '/' . $stylesheet;
echo css(url($stylesheet) . (is_file($path) ? '?v=' . filemtime($path) : ''));
