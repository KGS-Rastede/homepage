<div class="col-md-6 ml-auto mr-auto">
    <div class="rotating-card-container manual-flip">
        <div class="card card-rotate bg-success text-center">
            <div class="front">
                <div class="card-body">
                    <h3 class="card-title"><?= $subpage->titel() ?></h3>
                    <p class="card-description"><?= $subpage->textvorne() ?></p>
                    </br>
                    <?php if($image = $subpage->datei()->toFile()): ?>
                        <a href="<?php $subpage->datei()->toFile() ?>" download="18.png" class="btn btn-warning btn-round">Download</a>
                    <?php endif ?>
                    <button type="button" class="btn btn-warning btn-round btn-rotate"><i class="material-icons">refresh</i>umdrehen</button>
                </div>
            </div>
            <div class="back">
                <div class="card-body">
                    <h3 class="card-title"><?= $subpage->titel() ?></h3>
                    <p class="card-description"><?= $subpage->texthinten() ?></p>
                    <?php if($subpage->link() != ""): ?>
                        <a href="<?= $subpage->link() ?>" class="btn btn-warning btn-round" role="button">Mehr zum Thema</a>
                    <?php endif ?>
                    <button type="button" class="btn btn-warning btn-round btn-rotate"><i class="material-icons">refresh</i>umdrehen</button>
                </div>
            </div>
        </div>
    </div>
  </div>