<div class="row" id="masonry-element">
  <?php foreach ($page->gallery()->toFiles() as $image) : ?>

    <div class="col-12 col-md-6 d-flex justify-content-center align-items-center">
      <figure class="figure">
        <a href="<?= $image->url() ?>">
          <img class="w-100 img img-raised rounded" alt="<?= $image->alt() ?>" src="<?= $image->url() ?>">
        </a>
        <figcaption class="figure-caption"><?= $image->beschreibung() ?></figcaption>          
      </figure>
    </div>
        
  <?php endforeach ?>
</div>

<script>
  //Das masonry layout wird nach dem die Seite vollständig geladen ist einmal neugemacht,
    //sodass sich keine Bilder (die erst später laden und somit die Größe der Blogs verändern) überlappen
  "use strict"

  //das HTML Element erhalten in dem das masonry angewendet werden soll
  const elem = document.getElementById('masonry-element');

  //Masonry definieren und optionen festlegen
  const msnry = new Masonry( elem, {
    //optionen
    percentPosition: true
  });

  //wenn die Seite vollständig geladen ist
  window.onload = function() {
    //masonry einmal neu ausrichten
    msnry.layout();
  }
</script>