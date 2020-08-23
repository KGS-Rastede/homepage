<div class="col">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">
                <?= $subpage->title() ?>
            </h2>

            <div class="text-right">
                <svg class="bi" width="24" height="24">
                    <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#tags" />
                </svg>
                <?php foreach ($subpage->tags()->split() as $tag) : ?>
                    <a href="<?= url('blogs', ['params' => ['tag' => $tag]]) ?>">
                        <span class="badge rounded-pill bg-warning"><?= $tag ?></span>
                    </a>
                <?php endforeach ?>

                - <b><?= $subpage->author() ?></b> - <?= $subpage->date()->toDate("d.m.Y") ?>
            </div>

            <p class="card-text mt-2">
                <?= $subpage->Text()->blocks()->excerpt(250) ?>
            </p>
        </div>


        <div class="card-footer">
            <div class="text-right">
                <a href="<?= $subpage->url() ?>">
                    <button type="button" class="btn btn-warning">...weiterlesen</button>
                </a>
            </div>


        </div>
    </div>
</div>