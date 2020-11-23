<div class="card mb-3">
    <h2 class="ml-3 mt-2">Zur Zeit aktuelle Downloads</h2>
    <div class="card-body">
        
        <?php $count = 0; 
        foreach (page('allgemeines/wichtigelinks')->Schule()->toFiles() as $schnellverweis) : ?>
            <?php if ($schnellverweis->Startseite() == 'true') : ?>

                    <?php if ($count == 1) : ?>
                        <hr class="mt-3 mb-3">
                    <?php else :  $count = 1; endif ?>
                    
                    <a class="btn btn-danger btn-lg btn-block" href="<?= $schnellverweis->url() ?>" role="button">
                        <svg class="bi" width="24" height="24">
                            <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#cloud-download" />
                        </svg> 
                        <span class="font-weight-light">
                            <?= $schnellverweis->Anzeigename() ?>
                        </span>
                    </a>
                   
            <?php endif ?>
        <?php endforeach ?>
        <?php foreach (page('allgemeines/wichtigelinks')->Unterricht()->toFiles() as $schnellverweis) : ?>
            <?php if ($schnellverweis->Startseite() == 'true') : ?>

                    <?php if ($count == 1) : ?>
                        <hr class="mt-3 mb-3">
                    <?php else :  $count = 1; endif ?>
                
                    <a class="btn btn-danger btn-lg btn-block" href="<?= $schnellverweis->url() ?>" role="button">
                        <svg class="bi" width="24" height="24">
                            <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#cloud-download" />
                        </svg> 
                        <span class="font-weight-light">
                            <?= $schnellverweis->Anzeigename() ?>
                        </span>
                    </a>
                
            <?php endif ?>
        <?php endforeach ?>
    </div>
</div>