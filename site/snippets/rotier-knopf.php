<div class="col-md-6 col-lg-4 mr-auto">
    <div class="rotating-card-container manual-flip">
        <div class="card card-rotate bg-success">
            <div class="front">
                <div class="card-body">
                    <h5 class="card-category card-category-social">
                        <i class="material-icons">receipt</i> <?= $subpage->title() ?>
                    </h5>
                    <h4 class="card-title">
                        <a href="#pablo"> <?= $subpage->subtitle() ?></a>
                    </h4>
                    <p class="card-description">
                        <?= $subpage->vorne() ?>
                    </p>
                    <div class="stats text-center">
                        <button type="button" name="button" class="btn btn-white btn-fill btn-round btn-rotate">
                            <i class="material-icons">refresh</i> umdrehen
                        </button>
                    </div>
                </div>
            </div>
            <div class="back">
                <div class="card-body">
                    <br>
                    <h5 class="card-title">
                        <?= $subpage->title() ?>
                    </h5>
                    <p class="card-description">
                        <?= $subpage->hinten() ?>
                    </p>
                    <div class="stats text-center">

                    <?php if ($subpage->weiterleitung() ) : ?>

                        <a href="<?= $subpage->url() ?>" class="btn btn-white btn-round">
                            <i class="material-icons">subject</i> ...<?= $subpage->weiterleitung() ?>
                        </a>
                        <br>
                    <?php endif ?>
                        <div class="stats text-center">
                            <button type="button" name="button" class="btn btn-white btn-fill btn-round">
                                <i class="material-icons">attachment</i> Infozettel runterladen
                            </button>
                        </div>
                        <br>
                        <button type="button" name="button" class="btn btn-white btn-round btn-rotate">
                            <i class="material-icons">refresh</i> Back...
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>