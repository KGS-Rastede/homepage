<div class="card bg-primary mb-3">
  <div class="card-body">
    <img src="<?= $page->files()->find('deutsch.jpg')->url() ?>" class="card-img" alt="Fremdsprachen">

    <h3 class="card-category card-title mb-3 text-warning"><?= $block->name() ?></h3>
    <h4 class="card-title"><?= $block->kurzbeschreibung() ?></h4>

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