<?php snippet('header') ?>

<?php snippet('page-header') ?>


<div class="mb-3 align-items-center">
  <input type="search" class="" name="q" placeholder="Searchquery" value="<?= html($query) ?>">
  <button type="submit" class="btn btn-primary">Submit</button>
</div>


<form>
  <input class="form-control" type="search" name="q" value="<?= html($query) ?>">
  <input type="submit" for="floatingInput" value="🔍">
</form>

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