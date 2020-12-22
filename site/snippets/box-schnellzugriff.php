<?php if ( collection('sDownloads')->isNotEmpty() or collection('uDownloads')->isNotEmpty() ) : ?>

    <h2 class="mt-5 mb-3">Zur Zeit aktuelle Downloads</h2>
    <div class="card mb-3">
        <div class="card-body">
            
            <?php foreach (collection('sDownloads') as $schnellverweis) : ?>

                <?php if ( !$schnellverweis->isFirst(collection('sDownloads')) ) : ?>
                    <hr class="mt-3 mb-3">
                <?php endif //Trennstrich kommt nur wenn es Downloads vor diesem Element gibt ?>
                
                <a class="btn btn-danger btn-lg btn-block" href="<?= $schnellverweis->url() ?>" role="button">
                    <svg class="bi" width="24" height="24">
                        <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#cloud-download" />
                    </svg> 
                    <span class="font-weight-light">
                        <?= $schnellverweis->Anzeigename() ?>
                    </span>
                </a>
                
            <?php endforeach ?>
            <?php foreach (collection('uDownloads') as $schnellverweis) : ?>          

                <?php if ( !$schnellverweis->isFirst(collection('uDownloads')) or collection('sDownloads')->isNotEmpty() ) :  ?>
                    <hr class="mt-3 mb-3">
                <?php endif //Trennstrich kommt nur wenn es Downloads vor diesem Element gibt ?>
            
                <a class="btn btn-danger btn-lg btn-block" href="<?= $schnellverweis->url() ?>" role="button">
                    <svg class="bi" width="24" height="24">
                        <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#cloud-download" />
                    </svg> 
                    <span class="font-weight-light">
                        <?= $schnellverweis->Anzeigename() ?>
                    </span>
                </a>                   

            <?php endforeach ?>
        </div>
    </div>

<?php endif ?>