<div class="col-md-6 ml-auto mr-auto">
    <div class="card bg-success text-center">
        <div class="card-body">
            <h3 class="card-title"><?= $subpage->titel() ?></h3>
            <p class="card-description"><?= $subpage->text() ?></p>
            <?php if($file = $subpage->datei()->toFile()): ?>
                <a href="<?php echo $file->url() ?>" download="<?php echo $file->filename() ?>" class="btn btn-warning btn-round"><?php echo $file->name() ?></a>
            <?php endif ?>
            <?php if($subpage->link() != ""): ?>
                <a href="<?= $subpage->link() ?>" class="btn btn-warning btn-round" role="button">Mehr zum Thema</a>
            <?php endif ?>
        </div>
    </div>
</div>