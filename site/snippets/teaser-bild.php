<div class="col-md-5 ml-4">
    
        <?php if ($subpage->hasImages() > 0) : ?>
            <img src="<?= $subpage->images()->first()->url() ?>" class="card-img-top rounded" alt="<?= $subpage->images()->first()->alt() ?>">
        <?php else : ?>
        <?php endif ?>

    
</div>