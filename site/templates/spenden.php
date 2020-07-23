<?php snippet('header') ?>
<?php snippet('page-header') ?>


<h2><?= $page->heading() ?></h2>

<div class="col-lg-8 col-md-10 ml-auto mr-auto">
  <div class="table-responsive">
    <table class="table">
      <thead>
        <th>Datum</th>
        <th>Spender</th>
        <th>Betrag</th>
      </thead>
      <tbody>
        <?php foreach ($page->children() as $l) : ?>
          <tr>
            <td>
              <?= $l->datum() ?>
            </td>
            <td>
            <?= $l->spender() ?>
            </td>
            <td>
              <?= $l->betrag() ?>
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
</div>

<?php snippet('footer') ?>