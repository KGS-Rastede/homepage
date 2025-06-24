<?php snippet('default-page-layout', slots: true);
slot();
?>

<p class="mt-6 text-2xl leading-8 text-gray-600">
  <?= $page->text() ?>
</p>



<h1 class="my-8 text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">Sekretariate</h1>


<!-- Tables: Hover -->
<!-- Responsive Table Container -->
<div class="min-w-full overflow-x-auto rounded border border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-800">
  <!-- Table -->
  <table class="min-w-full align-middle">
    <!-- Table Header -->
    <thead>
      <tr>
        <th
          class="bg-gray-100/75 px-3 py-4 text-left font-semibold text-gray-900 dark:bg-gray-700/25 dark:text-gray-50">
          Aufgabenbereich
        </th>
        <th
          class="bg-gray-100/75 px-3 py-4 text-left font-semibold text-gray-900 dark:bg-gray-700/25 dark:text-gray-50">
          Name
        </th>
        <th
          class="bg-gray-100/75 px-3 py-4 text-left font-semibold text-gray-900 dark:bg-gray-700/25 dark:text-gray-50">
          Emailadresse
        </th>
        <th
          class="bg-gray-100/75 px-3 py-4 text-left font-semibold text-gray-900 dark:bg-gray-700/25 dark:text-gray-50">
          Telefonnummer
        </th>

      </tr>
    </thead>
    <!-- END Table Header -->

    <!-- Table Body -->
    <tbody>
      <?php foreach ($page->children() as $kontakt): ?>
        <?php if ($kontakt->fotoansicht() != 'sek') {
          continue;
        } ?>

        <tr class="hover:bg-gray-50 dark:hover:bg-gray-900/50">
          <td class="p-3 text-xl">
            <?= $kontakt->position() ?>
          </td>
          <td class="p-3">
            <p class="font-medium">
              <?= $kontakt->title() ?>
            </p>
          </td>
          <td class="p-3 text-gray-500 dark:text-gray-300">
            <script type="text/javascript">
              var mail = "<?= $kontakt->Heading() ?>";
              var en = "eu";
              var dom = "kgs-rastede";
              var at = "@";
              document.open();
              document.write(unescape("%3Ca href='mailto:" + mail + at + dom + "." + en + "'%3E" + mail + at + dom + "." + en + "%3C/a%3E"));
              document.close();
            </script>
          </td>
          <td class="p-3">
            <div
              class="inline-flex px-2 py-1 leading-4  dark:border-emerald-900 dark:bg-emerald-700 dark:bg-opacity-10 dark:font-medium dark:text-emerald-200">
              <?= $kontakt->phone() ?>
            </div>
          </td>

        </tr>
      <?php endforeach; ?>

    </tbody>
    <!-- END Table Body -->
  </table>
  <!-- END Table -->
</div>
<!-- END Responsive Table Container -->
<!-- END Tables: Hover -->



<h1 class="my-8 text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">Hausmeister und Schulassistenten</h1>

<!-- Tables: Hover -->
<!-- Responsive Table Container -->
<div class="min-w-full overflow-x-auto rounded border border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-800">
  <!-- Table -->
  <table class="min-w-full align-middle">
    <!-- Table Header -->
    <thead>
      <tr>
        <th
          class="bg-gray-100/75 px-3 py-4 text-left font-semibold text-gray-900 dark:bg-gray-700/25 dark:text-gray-50">
          Aufgabenbereich
        </th>
        <th
          class="bg-gray-100/75 px-3 py-4 text-left font-semibold text-gray-900 dark:bg-gray-700/25 dark:text-gray-50">
          Name
        </th>
        <th
          class="bg-gray-100/75 px-3 py-4 text-left font-semibold text-gray-900 dark:bg-gray-700/25 dark:text-gray-50">
          Emailadresse
        </th>
        <th
          class="bg-gray-100/75 px-3 py-4 text-left font-semibold text-gray-900 dark:bg-gray-700/25 dark:text-gray-50">
          Telefonnummer
        </th>

      </tr>
    </thead>
    <!-- END Table Header -->

    <!-- Table Body -->
    <tbody>
      <?php foreach ($page->children() as $kontakt): ?>
        <?php if ($kontakt->fotoansicht() != 'hausmeister') {
          continue;
        } ?>

        <tr class="hover:bg-gray-50 dark:hover:bg-gray-900/50">
          <td class="p-3 text-xl">
            <?= $kontakt->position() ?>
          </td>
          <td class="p-3">
            <p class="font-medium">
              <?= $kontakt->title() ?>
            </p>
          </td>
          <td class="p-3 text-gray-500 dark:text-gray-300">
            <script type="text/javascript">
              var mail = "<?= $kontakt->Heading() ?>";
              var en = "eu";
              var dom = "kgs-rastede";
              var at = "@";
              document.open();
              document.write(unescape("%3Ca href='mailto:" + mail + at + dom + "." + en + "'%3E" + mail + at + dom + "." + en + "%3C/a%3E"));
              document.close();
            </script>
          </td>
          <td class="p-3">
            <div
              class="inline-flex px-2 py-1 leading-4  dark:border-emerald-900 dark:bg-emerald-700 dark:bg-opacity-10 dark:font-medium dark:text-emerald-200">
              <?= $kontakt->phone() ?>
            </div>
          </td>

        </tr>
      <?php endforeach; ?>

    </tbody>
    <!-- END Table Body -->
  </table>
  <!-- END Table -->
</div>
<!-- END Responsive Table Container -->
<!-- END Tables: Hover -->

<?php endslot(); ?>
<?php endsnippet(); ?>
