<?php // site/blueprints/blocks/button.php
/* Es folgen einige CSS-Klassen um sicherzustellen, dass diese nicht aus dem CSS gepurged werden
btn-primary btn-secondary btn-info btn-warning btn-danger btn-light btn-dark
btn btn-sm btn-lg
btn-outline-primary btn-outline-secondary btn-outline-info btn-outline-warning btn-outline-danger btn-outline-light btn-outline-dark
*/

if (( !$block->isExternal()->toBool() && $block->pageLink()->isNotEmpty() ) || ( $block->isExternal()->toBool() && $block->externalLink()->isNotEmpty() )) : ?>
  <?php // die Größe ist entweder btn-lg, btn-sm oder kann bei "normaler" Größe weggelassen werden. Deshalb der leere String
  $size = $block->size();
  if ($size == 'normal') $size = '';
  else if($size->isNotEmpty()) $size = ' btn-' . $size;

  // Soll es nur outline sein -> wird 'outline' ergänzt es ergibt z.B. btn-outline-primary oder halt btn-primary
  // die optionale Größe wird hinten ergänzt, z.B. btn-sm oder btn-lg ?>
  <a role="button" class="btn btn-<?= $block->outline()->toBool() ? 'outline-' : '' ?><?= $block->buttoncolor() ?><?= $size ?> mb-3" 
    href="<?= $block->isExternal()->toBool() ? $block->externalLink() : $block->pageLink()->toPage()->url() 
    // Ist es eine externe Seite -> dann einach den Link; ist es eine interne Seite -> dann den Link aus der internen erzeugen ?>"
  >
    <?= // Entweder den eingegebenen Titel oder je nachdem ob es eine externe oder interne Seite ist als Fallback den Titel der Seite
    $block->text()->or($block->isExternal()->toBool() ? Url::short($block->externalLink()->value()) : $block->pageLink()->toPage()->title()) ?>
  </a>
<?php endif ?>