<?php snippet('header') ?>

<?php snippet('page-header') ?>

<!--SPRACHEN-->
<div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 gx-4">


  <div class="card bg-primary mb-3">
    <div class="card-body">
      <img src="<?= $page->files()->find('deutsch.jpg')->url() ?>" class="card-img" alt="Fremdsprachen">

      <h3 class="card-category card-title mb-3 text-warning">Konzeptkategorie 1</h3>
      <h4 class="card-title">Unterschrift Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit provident corrupti, rerum laborum labore exercitationem recusandae tempora quos reiciendis perferendis quas earum repudiandae, delectus molestias nihil rem ea hic odio.</h4>

      <div class="list-group">
        <a href="<?= page('beratungskonzept/mediatoren')->url() ?>" class="list-group-item list-group-item-light list-group-item-action">
          <i class="bi bi-chat-dots"></i> Mediatoren
        </a>
        <a href="<?= page('beratungskonzept/klassenlehrerinnen')->url() ?>" class="list-group-item list-group-item-light list-group-item-action">
          <i class="bi bi-chat-square-dots"></i> Klassenlehrer:innen
        </a>
        <a href="<?= page('beratungskonzept/sozialpaedagogen')->url() ?>" class="list-group-item list-group-item-light list-group-item-action">
          <i class="bi bi-chat-square-dots"></i> Sozialpädagog:innen
        </a>
        <a href="<?= page('beratungskonzept/beratung-und-praevention-in-der-schule')->url() ?>" class="list-group-item list-group-item-light list-group-item-action">
          <i class="bi bi-chat-square-dots"></i> Beratung und Prävention der Schule
        </a>
      </div>
    </div>

  </div>


  <!--AWT-->
  <div class="card bg-primary mb-3">
    <div class="card-body">
      <img src="<?= $page->files()->find('awt.jpg')->url() ?>" class="card-img" alt="AWT">

      <h3 class="card-category card-title mb-3 text-warning">Konzeptkategorie 1</h3>
      <h4 class="card-title">Unterschrift Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit provident corrupti, rerum laborum labore exercitationem recusandae tempora quos reiciendis perferendis quas earum repudiandae, delectus molestias nihil rem ea hic odio.</h4>
      <div class="list-group">
        <a href="<?= page('beratungskonzept/externeunterstuetzung')->url() ?>" class="list-group-item list-group-item-light list-group-item-action">
          <i class="bi bi-cash-stack"></i> Externe Unterstützung
        </a>
        <a href="<?= page('beratungskonzept/laufbahnberatung')->url() ?>" class="list-group-item list-group-item-light list-group-item-action">
          <i class="bi bi-screwdriver"></i> Laufbahnberatung
        </a>
        <a href="<?= page('beratungskonzept/tutorinnen')->url() ?>" class="list-group-item list-group-item-light list-group-item-action">
          <i class="bi bi-basket"></i> Tutor:innen
        </a>

      </div>
    </div>
  </div>



</div>


<?php snippet('footer') ?>