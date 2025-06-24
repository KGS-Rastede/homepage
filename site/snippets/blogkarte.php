<?php
/**
 * Diese Karte zeigt einen Blog mit seinen Tags, Titel, Autor und kurzem Ausschnitt an, jedoch ohne Bild.
 * Bietet sich an, um unter einer Seite Artikel zum gleichen Thema zu zeigen. 
*/
?>
<div class="flex flex-col my-4 bg-slate-50 rounded-lg overflow-hidden shadow-sm">
    <div class="p-2 lg:p-4 hover:bg-slate-100">
        <div class="mb-3">
            <?php snippet('tagliste', [
              'item' => $subpage,
            ]); ?>
        </div>
        <h4 class="font-bold text-lg sm:text-xl mb-2">
            <a href="javascript:void(0)" class="leading-7 text-slate-800 hover:text-slate-600">
                <?= $subpage->title() ?>
            </a>
        </h4>
        <p class="text-slate-600 text-sm font-medium mb-3">
            <?php if ($subpage->author()->isNotEmpty()): ?>
                (<?= $subpage->author() ?>)
            <?php endif; ?>
        </p>
        <p class="prose prose-indigo prose-sm">
            <?= $subpage->Text()->toBlocks()->excerpt(250) ?>
        </p>
        <div class="text-right">
            <?php snippet('knopf-klein', [
              'subpage' => $subpage,
              'knopftext' => 'weiterlesen',
            ]); ?>
        </div>
    </div>
</div>