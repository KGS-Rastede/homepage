<?php snippet('header') ?>

<?php snippet('page-header') ?>

<h2><?= $page->text()->kirbytext() ?></h2>

<form>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Email</label>
      <input type="email" class="form-control" id="inputEmail4">
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputCity">Klassenlehrer*in</label>
      <input type="text" class="form-control" id="inputCity">
    </div>
    <div class="form-group col-md-6">
      <label for="inputState">Klasse</label>
      <select id="inputState" class="form-control">
        <option selected>05a1</option>
        <option>05b1</option>
        <option>05a2</option>
        <option>05a3</option>
      </select>
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputCity">Klassenlehrer*in</label>
      <input type="text" class="form-control" id="inputCity">
    </div>
    <div class="form-group col-md-6">
      <label for="inputState">Klasse</label>
      <select id="inputState" class="form-control">
        <option selected>05a1</option>
        <option>05b1</option>
        <option>05a2</option>
        <option>05a3</option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="gridCheck">
      <label class="form-check-label" for="gridCheck">
        Check me out
      </label>
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Sign in</button>
</form>


<?php snippet('footer') ?>