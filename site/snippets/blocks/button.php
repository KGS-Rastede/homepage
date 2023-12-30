<?php // site/blueprints/blocks/button.php
if ((!$block->isExternal()->toBool() && $block->pageLink()->isNotEmpty()) || ($block->isExternal()->toBool() && $block->externalLink()->isNotEmpty())): ?>
  <?php // die Größe ist entweder btn-lg, btn-sm oder kann bei "normaler" Größe weggelassen werden. Deshalb der leere String
  
    // Soll es nur outline sein -> wird 'outline' ergänzt es ergibt z.B. btn-outline-primary oder halt btn-primary
    // die optionale Größe wird hinten ergänzt, z.B. btn-sm oder btn-lg ?>
  <a role="button"
    class="px-4 py-1 text-gray-800 font-semibold rounded-full border border-purple-200 hover:text-white hover:bg-slate-400 hover:border-transparent focus:outline-none focus:ring-2 focus:ring-slate-200 focus:ring-offset-2 text-center"
    href="<?= $block->isExternal()->toBool() ? $block->externalLink() : $block->pageLink()->toPage()->url()
      // Ist es eine externe Seite -> dann einach den Link; ist es eine interne Seite -> dann den Link aus der internen erzeugen   ?>">
    <?= // Entweder den eingegebenen Titel oder je nachdem ob es eine externe oder interne Seite ist als Fallback den Titel der Seite
        $block->text()->or($block->isExternal()->toBool() ? Url::short($block->externalLink()->value()) : $block->pageLink()->toPage()->title()) ?>
  </a>
<?php endif ?>