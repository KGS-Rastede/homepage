<?php if ($item->tags()->isNotEmpty()): ?>
    <div class="mb-3 inline-flex flex-wrap items-center gap-1">
        <?php foreach ($item->tags()->split() as $tag): ?>
            <div
                class="inline-flex rounded-full bg-indigo-100 px-2 py-1 text-sm leading-4 font-semibold text-indigo-800 dark:bg-indigo-900/75 dark:text-indigo-200">
                <a href="<?= url('blogs', [
                  'params' => ['tag' => urlencode($tag)],
                ]) ?>">
                    <?= htmlspecialchars($tag, ENT_QUOTES, 'UTF-8') ?>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
