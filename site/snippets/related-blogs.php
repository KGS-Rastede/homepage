<?php
/**
 * Unter einer Seite kann eine Liste mit verwandten Blogs angezeigt
 * werden.
 */
?>
<div class="mt-4">
  <h2 class="text-2xl border-t pt-4 font-semibold">
    <?= isset($relatedBlogsTitle) ? $relatedBlogsTitle : 'Blogbeiträge' ?>
  </h2>

  <?php foreach ($relatedBlogs as $blog) {
    snippet('blogkarte', ['subpage' => $blog]);
  } ?>
</div>