<?php snippet('header') ?>

<?php snippet('page-header') ?>

<span id="top"></span> <!-- Autscrolling -->
</br>
<form>
  <div class="form-floating input-group-lg mb-3 mx-3 d-block">
    <input type="search" class="form-control form-control-lg " id="floatingInput" placeholder="Testsuche" name="q" value="<?= html($query) ?>"> <!-- input-group-text -->
    <label for="floatingInput">Suchbegriff eingeben:</label>
    <div class="d-grid gap-2 col-6 mx-auto mt-3">
      <button class="btn btn-outline-secondary flex-nowrap fs-5" type="submit" formaction="#top">
        <svg class="bi" width="24" height="24">
          <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#search" />
        </svg> Los
      </button>
    </div>
  </div>
</form>

<div class="m-3 mt-5">
  <ul>
    <?php if ($results->isNotEmpty()) : ?>
      <?php foreach ($results as $result) {
        snippet('blogkarte', ['subpage' => $result]);
      } ?>
    <?php else : ?>
      <p>Es wurden leider keine Ergebnisse für "<?= html($query) ?>" gefunden.</p>
    <?php endif ?>
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