<?php snippet('header') ?>

<?php snippet('page-header') ?>

<span id="top"></span> <!-- Autscrolling -->

<form>
  <div class="form-floating input-group-lg mb-3 mx-3 d-block">
    <input type="search" class="form-control" id="floatingInput" placeholder="Testsuche" name="q" value="<?= html($query) ?>"> <!-- input-group-text -->
    <label for="floatingInput">Bitte geben Sie hier einen Suchbegriff ein:</label>
    <div class="d-grid gap-2 col-6 mx-auto mt-3">
      <button class="btn btn-outline-secondary flex-nowrap" type="submit" formaction="#top">Auf gut Glück!🔍</button>
    </div>
  </div>
</form>

Results:
<ul>
  <?php foreach ($results as $result): ?>
  <li>
    <a href="<?= $result->url() ?>">
      <?= $result->title() ?>
    </a>
  </li>
  <?php endforeach ?>
</ul>

<?php snippet('footer') ?>