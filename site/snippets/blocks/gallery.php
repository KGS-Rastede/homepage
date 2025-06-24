<?php
/** @var \Kirby\Cms\Block $block */
?>

<!-- https://getkirby.com/docs/reference/panel/blocks/gallery -->
<div class="bg-white dark:bg-gray-900 dark:text-gray-100">
    <div class="container mx-auto space-y-16 px-4 py-16 lg:px-8 lg:py-32 xl:max-w-7xl">
        <div class="grid grid-cols-1 gap-4 md:grid-cols-3 md:gap-8">

            <?php foreach ($block->images()->toFiles() as $image): ?>

                <div class="group relative overflow-hidden rounded-lg focus-within:ring-4 focus-within:ring-indigo-500 focus-within:ring-opacity-50 focus-within:ring-offset-2 focus:outline-none focus:ring-4 focus:ring-indigo-500 focus:ring-opacity-50 focus:ring-offset-2 dark:ring-offset-gray-900"
                    tabindex="0">
                    <img src="<?= $image->url() ?>"
                        class="transition duration-300 ease-out group-focus-within:scale-125 group-hover:scale-125 group-focus:scale-125"
                        alt="Image 1" />

                    <p>
                        <?= $image->beschreibung() ?>
                    </p>
                </div>

            <?php endforeach; ?>

        </div>
        <h2 class="text-center text-lg font-semibold leading-8 text-gray-900">
            <?= $block->caption() ?>
        </h2>
    </div>
</div>