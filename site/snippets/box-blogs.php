<h2 class="mt-5 mb-3">Aus dem Schulleben</h2>

<?php if (collection('blogs-startseite')->isNotEmpty()) : //wenn aktuelle Artikel vorhanden sind  
?>
<div class="row" data-masonry='{"percentPosition": true }'>
  <?php foreach (collection('blogs-startseite') as $subpage) {
    snippet('blogkartemasonry', ['subpage' => $subpage]);
  } ?>
</div>
<?php endif ?>

<a href="<?= page("blogs") ?>" class="btn btn-secondary mb-5" role="button">

  <?php if (collection('blogs-startseite')->isNotEmpty()) : //wenn aktuelle Artikel vorhanden sind 
  ?>
    Weitere Nachrichten aus der Schule &#8594;
  <?php else : //wenn keine aktuellen Artikel vorhanden sind 
  ?>
    Nachrichten aus der Schule &#8594;
  <?php endif ?>

</a>


<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>