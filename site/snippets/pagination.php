<?php if ($pagination->hasPages()) : 
$range = 4;
$extraSeiten = 3;
$gesamtSeitenzahl = $pagination->pages();
$aktuelleSeite = $pagination->page() ?>
    <nav>
        <ul class="pagination flex-wrap justify-content-center">

            <?php if ($pagination->hasPrevPage()) : ?>
             <li class="page-item">
                    <a class="page-link" href="<?= $pagination->prevPageURL() ?>">&laquo;</a>
             </li>           
            <?php endif ?>

            
            <?php for ($i = 1; $i <= $extraSeiten; $i++) : ?> 
                <?php if ($i < ( $aktuelleSeite - ($range/2) + 0.5 )) : ?>

                    <li class="page-item">
                        <a class="page-link" href="<?= $pagination->pageURL($i) ?>">
                            <?= $i ?>
                        </a>
                    </li>

                <?php endif ?>               
            <?php endfor ?>

            <!-- Hier nun die mittleren Elemente -->

            <?php foreach ($pagination->range($range) as $r) : 
            //Es folgen die ersten x Elemente der collection 
            ?>
                
                
                    <li class="page-item <?= $aktuelleSeite === $r ? 'active' : '' ?>">
                        <a class="page-link" <?= $aktuelleSeite === $r ? 'aria-current="page"' : '' ?> href="<?= $pagination->pageURL($r) ?>">
                            <?= $r ?>
                        </a>
                    </li>
                
            <?php endforeach 
            /* Hier steckt hinter:
            Wenn page() identisch ist mit $r schreibe aria-current (also aktuelle Seite),
            ansonsten mache '', also füge nichts ein. Das ist eine extreme Abkürzung.

            Damit wird im Endeffekt erreicht, dass mit nur einer Zeile die aktuelle Seite
            markiert wird */
            ?>

            <?php 
            for ($i = $gesamtSeitenzahl - ($extraSeiten-1); $i <= $gesamtSeitenzahl; $i++) : ?> 
                <?php if ($i > ($aktuelleSeite + $range/2)) : ?>

                    <li class="page-item">
                        <a class="page-link" href="<?= $pagination->pageURL($i) ?>">
                            <?= $i ?>
                        </a>
                    </li>

                <?php endif ?>               
            <?php endfor ?>

            <?php if ($pagination->hasNextPage()) : ?>
                <li class="page-item">
                    <a class="page-link" href="<?= $pagination->nextPageURL() ?>">&raquo;</a>
                </li>
            <?php endif ?>

        </ul>
    </nav>
<?php endif ?>