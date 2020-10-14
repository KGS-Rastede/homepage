<?php snippet('header') ?>

<?php snippet('page-header') ?>

<div class="mx-3">

    <?= $page->beschreibung()->blocks() ?>

    Erreichbar unter:
    <p>
    <a href="mailto:<?= $page->mailadresse()?>"><?= $page->mailadresse()?></a>
    </p>

    <?php snippet('gallery') ?>

</div>

<?php snippet('footer') ?>