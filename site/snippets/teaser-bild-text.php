<div class="col-md-6 mt-4">
    <div class="card-body">
        <h4 class="card-title">
            <a href="<?= $subpage->url() ?>"><?= $subpage->title() ?></a>
        </h4>
        <p class="card-category">
            <div class="author">
                von
                <a href="#">
                    <b><?= $subpage->author() ?></b>
                </a> Datum: <?= $subpage->date()->toDate("d.m.Y") ?>
            </div>
        </p>
        <div class="card-description">
            <?= $subpage->Text()->blocks()->excerpt(250) ?>
            <a href="<?=     $subpage->url() ?>">...weiterlesen</a>
        </div>
    </div>
</div>