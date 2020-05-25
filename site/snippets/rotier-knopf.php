<div class="infokasten">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title"><?= $subpage->titel() ?></h3>
            <p class="card-text"><?= $subpage->text() ?></p>
            <?php if($file = $subpage->datei()->toFile()): ?>
                <a href="<?php echo $file->url() ?>" download="<?php echo $file->filename() ?>" class="btn btn-primary"> <img src="<?= $kirby->url('assets') ?>/icons/info-square.svg"><?php echo $file->name() ?></a>
            <?php endif ?>
            <?php if($subpage->link() != ""): ?>
                <a href="<?= $subpage->link() ?>" class="btn btn-primary" role="button"> <img src="<?= $kirby->url('assets') ?>/icons/info-square.svg">Mehr zum Thema</a>
            <?php endif ?>
        </div>
    </div>
</div>