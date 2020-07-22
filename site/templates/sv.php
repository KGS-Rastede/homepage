<?php snippet('header') ?>

<?php snippet('page-header') ?>

<?php snippet('sidebar') ?>




<?php
  $items = page('sv/blogs')->children()->listed();

  $list = $items->paginate(5);

  snippet('blog-schlicht', [
    'items' => $list
  ])

?>



<?php snippet('footer') ?>