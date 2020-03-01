<div class="col-md-6">
    <div class="card bg-success text-center">
        <div class="card-body">
            <h3 class="card-title"><?= $subpage->titel() ?></h3>
            <p class="card-description"><?= $subpage->textvorne() ?></p>
            <?php if($image = $subpage->datei()->toFile()): ?>
                <a href="<?php $subpage->datei()->toFile() ?>" download="18.png" class="btn btn-warning btn-round">Download</a>
            <?php endif ?>
            <?php if($subpage->link() != ""): ?>
                <a href="<?= $subpage->link() ?>" class="btn btn-warning btn-round" role="button">Mehr zum Thema</a>
            <?php endif ?>
        </div>
    </div>
</div>