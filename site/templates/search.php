<?php snippet('default-page-layout', slots: true);
slot();
?>
<form>
  <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Suchen</label>
  <div class="relative">

    <input type="search" id="default-search" name="q" value="<?= html(
                                                                $query,
                                                              ) ?>"
      class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-700 focus:border-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-700 dark:focus:border-blue-500"
      placeholder="Suchen..." required>
    <button type="submit" formaction="#top"
      class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
      Suchen
    </button>
  </div>
</form>

<?php if ($query == ''): ?>
  <p>Das Suchfeld darf nicht leer sein.</p>
<?php else: ?>
  <?php if ($results->isNotEmpty()): ?>
    <div class="grid grid-cols-1 xl:grid-cols-2 xxl:grid-cols-3">
      <?php foreach ($results as $result): ?>
        <div class="col-span-1 px-4">
          <?php snippet('blogkarte', ['subpage' => $result]); ?>
        </div>
      <?php endforeach; ?>
    </div>
  <?php elseif ($results->isEmpty()): ?>
    <p>
      Es wurden leider keine Ergebnisse für "
      <?= html($query) ?>" gefunden.
    </p>
  <?php endif; ?>
<?php endif; ?>

<div class="flex justify-center">
  <?php
  $pagination = $results->pagination();
  snippet('pagination', [
    'pagination' => $pagination,
  ]);
  ?>
</div>

<?php endslot(); ?>
<?php endsnippet(); ?>