<?php snippet('header') ?>
<?php snippet('page-header') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 col-md-9 ml-auto mr-auto">
          <?php if ($page->heading()->isNotEmpty()): ?>
          <h2><?= $page->heading() ?></h2>
          <?php endif; ?>

          <?php if ($page->textBefore()->isNotEmpty()): ?>
          <div class="container">
            <?= $page->textBefore()->kirbyText() ?>
          </div>
          <?php endif; ?>

          <div class="table-responsive">
            <table class="table">
              <thead>
                <th>Jahr</th>
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

          <?php if ($page->textAfter()->isNotEmpty()): ?>
          <div class="container">
            <?= $page->textAfter()->kirbyText() ?>
          </div>
          <?php endif; ?>
        </div>

        <div class="col">
            <?php if ($page->sidebar()->isNotEmpty()) : ?>
            <div class="card mb-3">
                <h5 class="card-title text-center">
                    <?php if ($page->sidetitel()->isNotEmpty()) : ?>
                        <?= $page->sidetitel()->kirbytext() ?>
                    <?php else : ?>
                        <?= "Weitere Informationen" ?>
                    <?php endif ?>
                </h5>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <?php foreach ($page->sidebar()->toStructure() as $sidebar) : ?>
                        <li class="list-group-item">
                            <a href="<?= $sidebar->link() ?>"><?= $sidebar->name() ?></a>
                        </li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
            <?php endif ?>
        </div>
    </div>
</div>

<?php snippet('footer') ?>
