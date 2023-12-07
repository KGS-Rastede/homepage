<?php
$headingText = $block->text();

switch ($block->level()) {
    case 'h1':
        $class = 'text-6xl font-extrabold';
        break;
    case 'h2':
        $class = 'text-5xl font-bold';
        break;
    case 'h3':
        $class = 'text-4xl font-semibold';
        break;
    case 'h4':
        $class = 'text-3xl font-semibold';
        break;
    case 'h5':
        $class = 'text-2xl font-medium';
        break;
    case 'h6':
        $class = 'text-xl font-medium';
        break;
    default:
        $class = 'text-base font-normal';
        break;
}
?>

<<?= $block->level() ?> class="<?= $class ?> mt-4 mb-4"><?= $headingText ?></<?= $block->level() ?>>