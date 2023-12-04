<div class="row row-cols-1 row-cols-xs-1 row-cols-md-2 g-4">

    <?php foreach ($items as $item) : ?>

      <?php
      snippet('blogkarte', ['subpage' => $item]);
      ?>

    <?php endforeach ?>

  </div>