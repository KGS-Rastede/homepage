<?php
/**
 * Dieses Snippet stellt, dass Grundgerüste für jede normale Seite dar. Es sorgt dafür, dass
 * Header, Navigationsleiste und Footer richtig eingebunden werden.
 * Der tatsächliche Inhalt der Seite kann per Slot eingefügt werden. Der Inhalt ist bereits 
 * zentriert.
 */
?>
<?php snippet('header'); ?>
<?php snippet('page-header'); ?>

<main role="main">
  <div class="container mx-auto max-w-7xl p-3 lg:px-8 mb-2">
    <?= $slot ?>
  </div>
</main>

<?php snippet('footertw'); ?>
