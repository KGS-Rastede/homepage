<div class="card card-plain card-blog">
  <div class="row">

    <?php foreach ($blogs as $blog) : ?>
      <div class="col-md-5">
        <div class="card-header card-header-image">
          <?php if ($blog->hasImages() > 0) : ?>
            <img src="<?= $blog->images()->first()->url() ?>" class="img img-raised" alt="<?= $blog->images()->first()->alt() ?>">
          <?php else : ?>
            <img src="<?= $kirby->url('assets') ?>/logo-kgs.jpg" class="img img-raised" alt="Logo der KGS">
          <?php endif ?>
        </div>
      </div>
      <div class="col-md-7">
        <h6 class="card-category text-info">HEIR FEHLT CODE</h6>
        <h3 class="card-title">
          <a href="<?= $blog->url() ?>"><?= $blog->title() ?></a>
        </h3>
        <p class="card-description">
          <?= $blog->Text()->blocks()->excerpt(250) ?>
          <a href="<?= $blog->url() ?>">...weiterlesen</a>
        </p>
        <p class="author">
          von
          <a href="#pablo">
            <b><?= $blog->author() ?></b>
          </a> Datum: <?= $blog->date()->toDate("d.m.Y") ?>
        </p>
      </div>
    <?php endforeach ?>


  </div>
</div>