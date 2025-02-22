<h2 class="mt-4 font-semibold text-4xl">Aus dem Schulleben</h2>

<?php if (
  collection('blogs-startseite')->isNotEmpty()
):// Wenn aktuelle Artikel vorhanden sind
   ?>
  <div class="my-4 grid grid-cols-1 gap-2 md:grid-cols-2 2xl:grid-cols-3">
    <?php foreach (collection('blogs-startseite') as $subpage) {
      snippet('blogkarte-bild', ['subpage' => $subpage]);
    } ?>
  </div>
  <div class="p-4">
    <?= snippet('knopf-klein', [
      'subpage' => page('blogs'),
      'knopftext' => 'Weitere Nachrichten aus der Schule &#8594;',
    ]) ?>
  </div>

<?php else: ?>
  <div class="p-4">
    <?= snippet('knopf-klein', [
      'subpage' => page('blogs'),
      'knopftext' => 'Nachrichten aus der Schule &#8594;',
    ]) ?>
  </div>
<?php endif; ?>
