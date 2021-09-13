<h2 class="mt-5 mb-3">Aus dem Schulleben</h2>

<?php if (collection('blogs-startseite')->isNotEmpty()) : //wenn aktuelle Artikel vorhanden sind  
?>
  <div class="row" id="masonry-element">
    <?php foreach (collection('blogs-startseite') as $subpage) {
      snippet('blogkartemasonry', ['subpage' => $subpage]);
    } ?>
  </div>
<?php endif ?>

<a href="<?= page("blogs") ?>" class="btn btn-primary mb-5" role="button">

  <?php if (collection('blogs-startseite')->isNotEmpty()) : //wenn aktuelle Artikel vorhanden sind 
  ?>
    Weitere Nachrichten aus der Schule &#8594;
  <?php else : //wenn keine aktuellen Artikel vorhanden sind 
  ?>
    Nachrichten aus der Schule &#8594;
  <?php endif ?>

</a>

<!-- Masonry Skript -->
<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
<script>
  //Das masonry layout wird nach dem die Seite vollständig geladen ist einmal neugemacht,
  //sodass sich keine Bilder (die erst später laden und somit die Größe der Blogs verändern) überlappen
  "use strict"

  //das HTML Element erhalten in dem das masonry angewendet werden soll
  const elem = document.getElementById('masonry-element');

  //Masonry definieren und optionen festlegen
  const msnry = new Masonry(elem, {
    //optionen
    percentPosition: true
  });

  //wenn die Seite vollständig geladen ist
  window.onload = function() {
    //masonry einmal neu ausrichten
    msnry.layout();
  }
</script>