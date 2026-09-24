<!--
  Epochen-Abschnitt: großer Knoten auf der Timeline-Linie
  site/blueprints/blocks/geschichtsepoche.php
 -->
<div class="relative py-10 pl-8 md:py-14 lg:flex lg:justify-center lg:py-16 lg:pl-0">
  <h2
    class="inline-flex items-center gap-3 rounded-full bg-indigo-500 px-6 py-2 text-base font-bold uppercase tracking-widest text-white shadow-sm dark:bg-indigo-300 dark:text-slate-900"
  >
    <span class="size-2 rounded-full bg-white/80 dark:bg-slate-900/70" aria-hidden="true"></span>
    <?= $block->epochenname() ?>
    <span class="size-2 rounded-full bg-white/80 dark:bg-slate-900/70" aria-hidden="true"></span>
  </h2>
</div>