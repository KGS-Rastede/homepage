<div class="col">
    <div class="card mb-3">
        <div class="row g-0">
            <div class="col-md-4 p-2 bg-danger text-white lead">
                <?= $subpage->title() ?>
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <p class="card-text">
                        <!-- 
                            <p>
                            <svg class="bi" width="24" height="24">
                                <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#tags" />
                            </svg>
                            <?php foreach ($subpage->tags()->split() as $tag) : ?>
                                <a class="badge rounded-pill bg-info" href="<?= url('blogs', ['params' => ['tag' => $tag]]) ?>">
                                    <?= $tag ?>
                                </a>
                            <?php endforeach ?>

                        </p> 
                        -->

                        <?= $subpage->Text()->blocks()->excerpt(250) ?>
                        <?php if ($subpage->author()->isNotEmpty()) : ?>
                            (<?= $subpage->author() ?>)
                        <?php endif ?>
                    </p>
                    <p class="text-right">
                        <a href="<?= $subpage->url() ?>">weiterlesen...</a>

                    </p>
                </div>
            </div>
        </div>
    </div>
</div>