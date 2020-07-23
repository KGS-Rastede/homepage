<div class="col-md-4">
    
    <?php if ($subpage->hasImages() > 0) : ?>
        <img src="<?= $subpage->images()->first()->url() ?>" class="card-img-top rounded" alt="<?= $subpage->images()->first()->alt() ?>">
    <?php else : ?>
    <?php endif ?>

    
</div>