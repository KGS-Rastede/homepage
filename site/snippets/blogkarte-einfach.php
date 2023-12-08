<div
    class="flex flex-col shadow-xl ring-1 ring-gray-900/5 rounded-lg sm:max-w-lg sm:px-2 md:px-4 h-full bg-slate-50 hover:bg-slate-100">

    <p class="text-lg font-bold mt-auto text-red-700">

        <?= $subpage->title() ?>
    </p>

    <?= $subpage->Text()->toBlocks()->excerpt(250) ?>
    <?php if ($subpage->author()->isNotEmpty()): ?>
        (
        <?= $subpage->author() ?>)
    <?php endif ?>
    </p>

    <div class="text-right mt-2 mb-2">
        <?php snippet('knopf-klein', ['subpage' => $subpage, 'knopftext' => "weiterlesen"]); ?>
    </div>
</div>