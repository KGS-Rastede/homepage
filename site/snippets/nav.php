<nav class="site-header sticky-top py-1">
    <div class="container d-flex flex-column flex-md-row justify-content-between">

        <a class="py-2 d-none d-md-inline-block " href="<?= $site->url() ?>"><?= $site->title() ?></a>


        <?php foreach ($site->children()->listed() as $subpage) : ?>
            <a class="py-2 d-none d-md-inline-block" href="<?= $subpage->url() ?>"><?= $subpage->title() ?></a>
        <?php endforeach ?>
    </div>
</nav>