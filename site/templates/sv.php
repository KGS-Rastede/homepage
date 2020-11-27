<?php snippet('header') ?>
<?php snippet('page-header') ?>

<?php snippet('sidebar') ?>


<div class="container">
  <?php
    $items = page('sv/blogs')->children()->listed();

    $list = $items->paginate(5);

    snippet('blog-schlicht', [
      'items' => $list
    ])

  ?>
</div>


<?php snippet('footer') ?>