<h2 class="mt-4 font-semibold text-4xl">Aus dem Schulleben</h2>

<?php if (
  collection('blogs-startseite')->isNotEmpty()
):// Wenn aktuelle Artikel vorhanden sind
   ?>
  <div class="grid grid-cols-[repeat(auto-fill,_minmax(330px,_1fr))] gap-2 my-4">
    <?php foreach (collection('blogs-startseite') as $subpage) {
      snippet('blogkarte-bild', ['subpage' => $subpage]);
    } ?>
  </div>
  <div class="py-4">
    <?= snippet('knopf-klein', [
      'subpage' => page('blogs'),
      'knopftext' => 'Weitere Nachrichten aus der Schule &#8594;',
    ]) ?>
  </div>

<?php else: ?>
  <div class="py-4">
    <?= snippet('knopf-klein', [
      'subpage' => page('blogs'),
      'knopftext' => 'Nachrichten aus der Schule &#8594;',
    ]) ?>
  </div>
<?php endif; ?>
