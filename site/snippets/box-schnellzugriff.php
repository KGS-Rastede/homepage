<div class="card mb-3 mt-3">
    <div class="card-body ">
        <h3>Zur Zeit aktuelle Downloads</h3>
        <?php foreach (page('allgemeines/wichtigelinks')->inhalte()->toStructure() as $schnellverweis) : ?>
            <?php if ($schnellverweis->startseite() == 'true') : ?>
                <li class="list-group-item">
                    <p>
                        <?= $schnellverweis->beschreibung() ?>
                    </p>
                    <a class="btn btn-warning btn-lg btn-block" href="<?= $schnellverweis->link()->toFiles() ?>" role="button">
                        <svg class="bi" width="24" height="24">
                            <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#cloud-download" />
                        </svg> <?= $schnellverweis->name() ?>
                    </a>
                </li>
            <?php endif ?>
        <?php endforeach ?>
    </div>
</div>