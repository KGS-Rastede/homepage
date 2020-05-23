<div class="col-md-6 ml-auto mr-auto">
    <div class="card border-dark mb-3" style="max-width: 18rem;">
        <div class="card-body text-dark">
            <h3 class="card-title"><?= $subpage->titel() ?></h3>
            <p class="card-text"><?= $subpage->text() ?></p>
            <?php if($file = $subpage->datei()->toFile()): ?>
                <a href="<?php echo $file->url() ?>" download="<?php echo $file->filename() ?>" class="btn btn-primary btn-round"> <img src="<?= $kirby->url('assets') ?>/icons/info-square.svg"><?php echo $file->name() ?></a>
            <?php endif ?>
            <?php if($subpage->link() != ""): ?>
                <a href="<?= $subpage->link() ?>" class="btn btn-secondary" role="button"> <img src="<?= $kirby->url('assets') ?>/icons/info-square.svg">Mehr zum Thema</a>
            <?php endif ?>
        </div>
    </div>
</div>