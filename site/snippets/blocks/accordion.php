<?php if ($block->accordion()->isNotEmpty()) : 
  $id = $block->accordionid();
  $count = 1;
  $acc = $block->accordion()->toStructure() ?>

  <?php if ($block->flush()->toBool()) : // Wenn das Design flush ausgewählt wurde ?>
    <div class="accordion accordion-flush mb-3" id="accordionBlock<?= $id ?>">
  <?php else : // Nicht das flush desgin ?>
    <div class="accordion mb-3" id="accordionBlock<?= $id ?>">
  <?php endif ?>

    <?php if ($block->accfirst()->toBool()) : $count ++; // Falls das erste Item bei Laden offen sein soll ?>
      <?php $accordion = $acc->first() // erstes Element aus der Struktur erhalten ?>

      <div class="accordion-item">
        <h2 class="accordion-header" id="heading<?= $id ?>-<?= $count ?>">
          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $id ?>-<?= $count ?>" aria-expanded="true" aria-controls="collapse<?= $id ?>-<?= $count ?>">
            <?= $accordion->accordionheading()->or("Hier fehlt noch eine Überschrift") ?>
          </button>
        </h2>
        <div id="collapse<?= $id ?>-<?= $count ?>" class="accordion-collapse collapse show" aria-labelledby="heading<?= $id ?>-<?= $count ?>" data-bs-parent="#accordionBlock<?= $id ?>">
          <div class="accordion-body">
            <?= $accordion->accordionbody()->kt()->or("Hier fehlt noch Inhalt") ?>
          </div>
        </div>
      </div>

      <?php $acc = $acc->slice(1) // das erste Item aus der Struktur entfernen, diese wurde bereits bearbeitet ?>
    <?php endif ?>


    <?php foreach ($acc as $accordion) : $count++ // Alle übrigen Items ?>
      <div class="accordion-item">
        <h2 class="accordion-header" id="heading<?= $id ?>-<?= $count ?>">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $id ?>-<?= $count ?>" aria-expanded="false" aria-controls="collapse<?= $id ?>-<?= $count ?>">
            <?= $accordion->accordionheading()->or("Hier fehlt noch ein Überschrift") ?>
          </button>
        </h2>
        <div id="collapse<?= $id ?>-<?= $count ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $id ?>-<?= $count ?>" data-bs-parent="#accordionBlock<?= $id ?>">
          <div class="accordion-body">
            <?= $accordion->accordionbody()->kt()->or("Hier fehlt noch Inhalt") ?>
          </div>
        </div>
      </div>
    <?php endforeach ?>

  </div>
<?php endif ?>
