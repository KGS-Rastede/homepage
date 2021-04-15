<?php snippet('header') ?>
<?php snippet('page-header') ?>


<?php snippet('sidebar') ?>

<div class="container">
  <div class="table-responsive">
    <table class="table">
      <thead>
        <th>Name</th>
        <th>Quarantäne</th>
        <th>Infiziert</th>
      </thead>
      <tbody>
        <?php foreach ($page->children() as $l) : ?>
          <tr>
            <td>
              <?= $l->name() ?>
            </td>
            <td>
            <?= $l->quarantaene() ?>

            </td>
            <td>
              <?= $l->infiziert() ?>
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>

</div>

<?php snippet('footer') ?>