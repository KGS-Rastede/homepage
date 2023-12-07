<?php

/** @var \Kirby\Cms\Block $block */ ?>





<!-- Image Overlays Section: Image Zoom In -->
<div class="bg-white dark:bg-gray-900 dark:text-gray-100">
    <div class="container mx-auto space-y-16 px-4 py-16 lg:px-8 lg:py-32 xl:max-w-7xl">
        <div class="grid grid-cols-1 gap-4 md:grid-cols-3 md:gap-8">

            <?php foreach ($block->images()->toFiles() as $image) : ?>

                <div class="group relative overflow-hidden rounded-lg bg-indigo-900 focus-within:ring-4 focus-within:ring-indigo-500 focus-within:ring-opacity-50 focus-within:ring-offset-2 focus:outline-none focus:ring-4 focus:ring-indigo-500 focus:ring-opacity-50 focus:ring-offset-2 dark:ring-offset-gray-900" tabindex="0">
                    <img src="<?= $image->url() ?>" class="transition duration-300 ease-out group-focus-within:scale-125 group-hover:scale-125 group-focus:scale-125" alt="Image 1" />

                    <!-- Item Overlay -->
                    <div class="absolute inset-0 flex flex-col items-center justify-center rounded bg-slate-900 bg-opacity-80 opacity-0 transition duration-300 ease-out group-focus-within:opacity-100 group-hover:opacity-100 group-focus:opacity-100">
                        <div class="text-center">
                            <h4 class="text-lg font-semibold text-white"><?= $image->beschreibung() ?></h4>
                        </div>
                    </div>
                    <!-- END Item Overlay -->
                </div>

            <?php endforeach ?>

        </div>
    </div>
</div>
<!-- END Image Overlays Section: Image Zoom In -->