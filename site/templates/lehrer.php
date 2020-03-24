<?php snippet('header') ?>
<?php snippet('page-header') ?>


<h2><?= $page->heading() ?></h2>

<div class="col-lg-8 col-md-10 ml-auto mr-auto">
  <div class="table-responsive">
    <table class="table">
    <thead> 
            <th>Name</th>
            <th>Kürzel</th>
            <th>Fächer</th>
        </thead>
      <tbody>
        <?php foreach ($page->children() as $l) : ?>
          <tr>
            <td>
              <?= $l->name() ?>
            </td>
            <td>
              <a href="mailto:<?= $l->kuerzel()->upper() ?>@kgs-rastede.de">
                <?= $l->kuerzel()->upper() ?>
              </a>
            </td>
            <td>
              <?= $l->faecher() ?>
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
</div>

<?php snippet('footer') ?>