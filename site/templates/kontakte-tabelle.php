<?php snippet('default-page-layout', slots: true);
slot();
?>

<p class="mt-6 text-2xl leading-8 text-slate-600">
  <?= $page->text() ?>
</p>



<h1 class="my-8 text-4xl font-bold tracking-tight text-slate-900 sm:text-6xl">Sekretariate</h1>


<!-- Tables: Hover -->
<!-- Responsive Table Container -->
<div class="min-w-full overflow-x-auto rounded border border-slate-200 bg-white dark:border-slate-700 dark:bg-slate-800">
  <!-- Table -->
  <table class="min-w-full align-middle">
    <!-- Table Header -->
    <thead>
      <tr>
        <th
          class="bg-slate-100/75 px-3 py-4 text-left font-semibold text-slate-900 dark:bg-slate-700/25 dark:text-slate-50">
          Aufgabenbereich
        </th>
        <th
          class="bg-slate-100/75 px-3 py-4 text-left font-semibold text-slate-900 dark:bg-slate-700/25 dark:text-slate-50">
          Name
        </th>
        <th
          class="bg-slate-100/75 px-3 py-4 text-left font-semibold text-slate-900 dark:bg-slate-700/25 dark:text-slate-50">
          Emailadresse
        </th>
        <th
          class="bg-slate-100/75 px-3 py-4 text-left font-semibold text-slate-900 dark:bg-slate-700/25 dark:text-slate-50">
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

        <tr class="hover:bg-slate-50 dark:hover:bg-slate-900/50">
          <td class="p-3 text-xl">
            <?= $kontakt->position() ?>
          </td>
          <td class="p-3">
            <p class="font-medium">
              <?= $kontakt->title() ?>
            </p>
          </td>
          <td class="p-3 text-slate-500 dark:text-slate-300">
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
              class="inline-flex px-2 py-1 leading-4  dark:border-emerald-900 dark:bg-emerald-700/10 dark:font-medium dark:text-emerald-200">
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



<h1 class="my-8 text-4xl font-bold tracking-tight text-slate-900 sm:text-6xl">Hausmeister und Schulassistenten</h1>

<!-- Tables: Hover -->
<!-- Responsive Table Container -->
<div class="min-w-full overflow-x-auto rounded border border-slate-200 bg-white dark:border-slate-700 dark:bg-slate-800">
  <!-- Table -->
  <table class="min-w-full align-middle">
    <!-- Table Header -->
    <thead>
      <tr>
        <th
          class="bg-slate-100/75 px-3 py-4 text-left font-semibold text-slate-900 dark:bg-slate-700/25 dark:text-slate-50">
          Aufgabenbereich
        </th>
        <th
          class="bg-slate-100/75 px-3 py-4 text-left font-semibold text-slate-900 dark:bg-slate-700/25 dark:text-slate-50">
          Name
        </th>
        <th
          class="bg-slate-100/75 px-3 py-4 text-left font-semibold text-slate-900 dark:bg-slate-700/25 dark:text-slate-50">
          Emailadresse
        </th>
        <th
          class="bg-slate-100/75 px-3 py-4 text-left font-semibold text-slate-900 dark:bg-slate-700/25 dark:text-slate-50">
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

        <tr class="hover:bg-slate-50 dark:hover:bg-slate-900/50">
          <td class="p-3 text-xl">
            <?= $kontakt->position() ?>
          </td>
          <td class="p-3">
            <p class="font-medium">
              <?= $kontakt->title() ?>
            </p>
          </td>
          <td class="p-3 text-slate-500 dark:text-slate-300">
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
              class="inline-flex px-2 py-1 leading-4  dark:border-emerald-900 dark:bg-emerald-700/10 dark:font-medium dark:text-emerald-200">
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
