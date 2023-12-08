<div class="basis-1/4">


    <?php if ($image = $subpage->gallery()->toFile()): ?>

        <div
            class="col-span-1 flex flex-col x-6 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 sm:mx-auto sm:max-w-lg sm:rounded-lg sm:px-2 md:px-4 h-full bg-slate-50 hover:bg-slate-100">

            <img src="<?= $image->url() ?>" class="card-img-top" alt="<?= $image->alt() ?>">

            <p class="text-lg font-bold mb-2 text-red-700">
                <?= $subpage->title() ?>
            </p>

            <?= $subpage->Text()->toBlocks()->excerpt(250) ?>
            <?php if ($subpage->author()->isNotEmpty()): ?>
                (
                <?= $subpage->author() ?>)
            <?php endif ?>

            <div class="text-right mt-auto">
                <?php snippet('knopf-klein', ['subpage' => $subpage, 'knopftext' => "weiterlesen"]); ?>
            </div>
        </div>



    <?php elseif ($block = $subpage->text()->toBlocks()->filterBy("type", "==", "image")->first()): ?>
        <?php $image = $block->image()->toFile() ?>

        <div
            class="col-span-1 flex flex-col x-6 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 sm:mx-auto sm:max-w-lg sm:rounded-lg sm:px-2 md:px-4 h-full bg-slate-50 hover:bg-slate-100">
            <img src="<?= $image->url() ?>" alt="<?= $block->alt()->or($image->alt()) ?>">

            <p class="text-lg  font-bold mb-2 text-red-700">
                <?= $subpage->title() ?>
            </p>


            <?= $subpage->Text()->toBlocks()->excerpt(250) ?>
            <?php if ($subpage->author()->isNotEmpty()): ?>
                (
                <?= $subpage->author() ?>)
            <?php endif ?>

            <div class="text-right mt-auto">
                <?php snippet('knopf-klein', ['subpage' => $subpage, 'knopftext' => "weiterlesen"]); ?>
            </div>
        </div>


    <?php else: ?>

        <div
            class="col-span-1 flex flex-col x-6 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 sm:mx-auto sm:max-w-lg sm:rounded-lg sm:px-2 md:px-4 h-full bg-slate-50 hover:bg-slate-100">

            <p class="text-lg font-bold mb-2 text-red-700">

                <?= $subpage->title() ?>
            </p>

            <?= $subpage->Text()->toBlocks()->excerpt(250) ?>
            <?php if ($subpage->author()->isNotEmpty()): ?>
                (
                <?= $subpage->author() ?>)
            <?php endif ?>
            </p>

            <div class="text-right mt-auto">
                <?php snippet('knopf-klein', ['subpage' => $subpage, 'knopftext' => "weiterlesen"]); ?>
            </div>
        </div>


    <?php endif ?>

</div>