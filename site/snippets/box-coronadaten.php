<table class="table">
  <thead>
    <th>Name</th>
    <th>Quarantäne</th>
    <th>Infiziert</th>
  </thead>
  <tbody>
    <?php foreach ($coronapage->children() as $l) : ?>
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