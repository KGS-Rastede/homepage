<!-- Erzeugt einen kleinen Knopf mit der Beschriftung $knopftext, so dass das
Layout überall konsistent ist-->

<a href="<?= $subpage->url() ?>"
    class="inline-flex items-center justify-center gap-2 rounded-lg border border-slate-700 bg-slate-500 px-3 py-2 text-sm font-semibold leading-5 text-white hover:border-slate-600 hover:bg-slate-600 hover:text-white focus:ring focus:ring-slate-400/50 active:border-slate-700 active:bg-slate-700 dark:focus:ring-slate-400/90">
    <?= $knopftext ?>
</a>