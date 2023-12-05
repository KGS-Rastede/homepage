<div class="flex flex-col overflow-hidden rounded-lg bg-white shadow-sm my-4 dark:bg-gray-800 dark:text-gray-100">
  <!-- Card Body -->
  <div
    class="w-full grow space-y-4 border-l-8 border-red-500 p-5 sm:flex sm:items-center sm:justify-between sm:space-x-2 sm:space-y-0">
    <div class="sm:w-1/2">
      <h3 class="mb-1 text-2xl font-semibold">
        <?= $block->ueberschrift() ?>
      </h3>
      <p class="mb-4 text-gray-500 dark:text-gray-400">
        <?= $block->feldinhalt()->kt() ?>
      </p>

    </div>

  </div>
  <!-- END Card Body -->
</div>
<!-- END Card -->