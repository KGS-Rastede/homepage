<?php snippet('header') ?>

<?php snippet('page-header') ?>

<div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 gx-4">


<?= $page->beratungstyp()->toBlocks() ?>

</div>

<?php snippet('footer') ?>