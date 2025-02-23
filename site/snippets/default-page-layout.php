<?php
/**
 * Dieses Snippet stellt, dass Grundgerüste für jede normale Seite dar. Es sorgt dafür, dass
 * Header, Navigationsleiste und Footer richtig eingebunden werden.
 * Der tatsächliche Inhalt der Seite kann per Slot eingefügt werden. Der Inhalt ist bereits 
 * zentriert. Optional kann die sidebar und zugehörige Blogs angezeigt werden.
 */
?>
<?php snippet('header'); ?>
<?php snippet('page-header'); ?>

<main role="main">
  <div class="container mx-auto max-w-7xl p-3 lg:px-8 mb-2">
    <?= $slot ?>
  

    <?php if (isset($sidebarEnabled) && $sidebarEnabled) {
      snippet('sidebar');
    } ?>

    <?php if (isset($relatedBlogs) && $relatedBlogs->isNotEmpty()): ?>
      <div class="mt-4">
        <h2 class="text-2xl border-t pt-4 font-semibold">
          <?= isset($relatedBlogsTitle) ? $relatedBlogsTitle : 'Blogbeiträge' ?>
        </h2>

        <?php foreach ($relatedBlogs as $blog) {
          snippet('blogkarte', ['subpage' => $blog]);
        } ?>
      </div>
    <?php endif; ?>

  </div>


</main>

<?php snippet('footertw'); ?>
