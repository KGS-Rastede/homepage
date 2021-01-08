<?php snippet('header') ?>

<?php snippet('page-header') ?>

<span id="top"></span> <!-- Autscrolling -->
</br>
<form>
  <div class="form-floating input-group-lg mx-auto d-block w-75">
    <input type="search" class="form-control form-control-lg " id="floatingInput" placeholder="Testsuche" name="q" value="<?= html($query) ?>"> <!-- input-group-text -->
    <label for="floatingInput">Suchbegriff eingeben:</label>
    <div class="d-grid gap-2 col-6 mx-auto mt-3">
      <button class="btn btn-outline-secondary flex-nowrap fs-6" type="submit" formaction="#top">
      <i class="bi bi-search"></i> Suchen!
      </button>
    </div>
  </div>
</form>

<div class="mx-2 mt-5">
  <ul>
    <?php if($query == ""):?>
      <p class="fs-4">Das Suchfeld darf nicht leer sein.</p> 
    <?php else: ?>
      <?php if ($results->isNotEmpty()) : ?>
        <div class="row row-cols-1 row-cols-xl-2 row-cols-xxl-3">
          <?php foreach ($results as $result): ?>
            <div class="col">
              <?php snippet('blogkarte', ['subpage' => $result]); ?>
            </div>
          <?php endforeach?>
        </div>
      <?php elseif($results->isEmpty()) : ?>
        <p class="fs-4">Es wurden leider keine Ergebnisse für  "<?= html($query) ?>" gefunden.</p>
      <?php endif ?>
    <?php endif?>
  </ul>

  <div class="d-flex justify-content-center">
    <?php
    $pagination = $results->pagination();

    snippet('pagination', [
      'pagination' => $pagination
    ])
    ?>
  </div>
</div>


<?php snippet('footer') ?>