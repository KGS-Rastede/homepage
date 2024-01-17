<h2 class="font-semibold text-xl">Aus dem Schulleben</h2>

<?php if (collection('blogs-startseite')->isNotEmpty()): // Wenn aktuelle Artikel vorhanden sind  
    ?>
  <div class="grid grid-cols-1 md:grid-cols-2 2xl:grid-cols-3 gap-2">
    <?php foreach (collection('blogs-startseite') as $subpage): ?>
      <?php snippet('blogkarte-bild', ['subpage' => $subpage]); ?>
    <?php endforeach; ?>
  </div>
<?php endif ?>

<div class="p-4">

  <a href="<?= page("blogs")->url() ?>">
    <?php if (collection('blogs-startseite')->isNotEmpty()): // Wenn aktuelle Artikel vorhanden sind  
        ?>
      <?php snippet('knopf-klein', ['subpage' => page("blogs"), 'knopftext' => "Weitere Nachrichten aus der Schule &#8594;"]); ?>
    <?php else: // Wenn keine aktuellen Artikel vorhanden sind  
        ?>
      <?php snippet('knopf-klein', ['subpage' => page("blogs"), 'knopftext' => "Nachrichten aus der Schule &#8594;"]); ?>
    <?php endif ?>
  </a>

</div>