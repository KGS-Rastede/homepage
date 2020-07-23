<div class="col-md-8">
    <div class="card-body">
        <h4 class="card-title">
            <a href="<?= $subpage->url() ?>"><?= $subpage->title() ?></a>
        </h4>
        <p>
            von <b><?= $subpage->author() ?></b>
            <br>
            Datum: <?= $subpage->date()->toDate("d.m.Y") ?>
        </p>
        <p class="card-text">
            <?= $subpage->Text()->blocks()->excerpt(250) ?>
            <a href="<?= $subpage->url() ?>" class="card-link">...weiterlesen</a>
        </p>
    </div>
</div>