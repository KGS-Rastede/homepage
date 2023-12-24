<?php snippet('header') ?>

<?php snippet('page-header') ?>

<div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 gx-4">

  <?php foreach ($page->children() as $fb): ?>

    <div class="lg:col-start-3 lg:row-end-1 px-2 pb-4">
      <div class="rounded-lg bg-gray-50 shadow-sm ring-1 ring-gray-900/5 mt-2">
        <dl class="flex flex-wrap">
          <div class="flex-auto pl-6 pt-6">
            <?php
            $images = $fb->symbolbild()->toFiles();
            foreach ($images as $image): ?>
              <img src="<?= $image->url() ?>" alt="">
            <?php endforeach ?>
            <dt class="text-2xl mt-2 font-semibold leading-6 text-gray-900">
              <?= $fb->title() ?>
            </dt>
            <dd class="mt-1 text-xl leading-6 text-gray-900">
              <?= $fb->bezeichnung() ?>
              <?= $fb->namefbl() ?>
            </dd>
          </div>
        </dl>
        <div class="mt-6 border-t border-gray-900/5 px-6 py-6">
          <?php
          $relatedPages = $fb->pages()->toPages();
          foreach ($relatedPages as $relatedPage): ?>
            <div class="mt-6 flex w-full flex-none gap-x-4 border-t border-gray-900/5 px-6 pt-6 hover:bg-slate-100">
              <a href="<?= $relatedPage->url() ?>">
                <?= $relatedPage->title() ?>
              </a>
            </div>
          <?php endforeach ?>
        </div>
      </div>
    </div>

  <?php endforeach; ?>
</div>


<?php snippet('footertw') ?>