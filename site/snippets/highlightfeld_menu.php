<?php if ($feld_toggle): ?>
  <a
    href="<?= $feld_link ?>"
    class="block space-y-3 text-sm font-semibold transition-opacity hover:text-kgs-blue hover:opacity-90 dark:hover:text-kgs-lblue">

    <?php if ($feld_bild?->isNotEmpty()): ?>
      <img
        src="<?= $feld_bild->url() ?>"
        class="rounded-lg"
        alt="<?= $feld_bild->alt()->or($feld_text) ?>" />
    <?php endif; ?>


    <h5>
      <?= $feld_text ?>
    </h5>
  </a>
<?php endif; ?>