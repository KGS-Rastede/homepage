<?php if (!empty($relatedBlogs)): ?>

  <div class="mt-4">
    <h2 class="text-2xl border-t pt-4 font-semibold">
      <?= $relatedBlogsTitle ?? 'Blogbeiträge' ?>
    </h2>

    <?php foreach ($relatedBlogs as $blog) {
      snippet('blogkarte', ['subpage' => $blog]);
    } ?>
  </div>

<?php endif; ?>
