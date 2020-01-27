<div class="col-md-6">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">
                <a href="<?= $subpage->url() ?>"><?= $subpage->title() ?></a>
            </h4>
            <p class="category">
                <p class="author">
                    von
                    <a href="#">
                        <b><?= $subpage->author() ?></b>
                    </a> Datum: <?= $subpage->date()->toDate("d.m.Y") ?>
                </p>
            </p>
        </div>
        <div class="card-body">
            <?= $subpage->Text()->blocks()->excerpt(250) ?>
            <a href="<?= $subpage->url() ?>">...weiterlesen</a>
        </div>
    </div>
</div>