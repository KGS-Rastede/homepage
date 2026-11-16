<?php
// Gleiche Tailwind-Dateien wie im regulären Seitenheader, ohne Navigation.
echo css(option('debug', false)
    ? 'assets/css/twkgs_shrinked.css'
    : 'assets/css/twkgs_shrinked.min.css');
