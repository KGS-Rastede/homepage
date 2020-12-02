<?php if ($pagination->hasPages()) : 
$range = 5; //Wird für die Länge der bzw. Anzahl der Elemente verwendet. Außerdem zur Berechnung der Extra Seiten: https://getkirby.com/docs/reference/objects/pagination/range
$extraSeiten = 2; //Die Anzahl der Extraseiten. Also die ersten "paar" und die letzten "paar" Seiten
$gesamtSeitenzahl = $pagination->pages();
$aktuelleSeite = $pagination->page() ?>
    <nav>
        <ul class="pagination flex-wrap justify-content-center">

            <?php if ($pagination->hasPrevPage()) : //Wenn es eine Seite vor der aktuellen Seite gibt wird ein Doppelpfeil («) angezeigt, der zur vorherigen Seite führt?>
                <li class="page-item">
                    <a class="page-link" href="<?= $pagination->prevPageURL() ?>">&laquo;</a>
                </li>           
            <?php endif ?>

            
            <?php for ($i = 1; $i <= $extraSeiten; $i++) : ?> 
                <?php if ($i < ( $aktuelleSeite - ($range/2) + 0.5 )) :

                        //d-none d-sm-block => auf dem Handy nicht anzeigen?>
                    <li class="page-item d-none d-sm-block">
                        <a class="page-link" href="<?= $pagination->pageURL($i) ?>">
                            <?= $i ?>
                        </a>
                    </li>

                <?php endif ?>               
            <?php endfor ?>

            <?php if ($extraSeiten + 1 < $aktuelleSeite - ($range/2) +0.5 ) : 
                //Es gibt Elemente zwischen der letzten ExtraSeite und den Seiten, die normal angzeigt werden. +0.5 siehe oben
                
                    //d-none d-sm-blok => auf dem Handy nicht anzeigen?>
                <li class="page-item d-none d-sm-block">
                    <a class="page-link">
                        ...
                    </a>
                </li>
            <?php endif ?>


            <!-- Hier nun die mittleren Elemente -->
            <?php foreach ($pagination->range($range) as $r) : ?>                
                
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


            <?php if ($gesamtSeitenzahl - $extraSeiten > $aktuelleSeite + ($range/2)) : 
                //Es gibt Elemente zwischen der letzten normalen Seite und der ersten extra Seite

                    //d-none d-sm-blok => auf dem Handy nicht anzeigen?>
                <li class="page-item d-none d-sm-block">
                    <a class="page-link">
                        ...
                    </a>
                </li>
            <?php endif ?>

            <?php for ($i = $gesamtSeitenzahl - ($extraSeiten-1); $i <= $gesamtSeitenzahl; $i++) : ?> 
                <?php if ($i > ($aktuelleSeite + $range/2)) : 
                    
                        //d-none d-sm-blok => auf dem Handy nicht anzeigen?>
                    <li class="page-item d-none d-sm-block">
                        <a class="page-link" href="<?= $pagination->pageURL($i) ?>">
                            <?= $i ?>
                        </a>
                    </li>

                <?php endif ?>               
            <?php endfor ?>

            <?php if ($pagination->hasNextPage()) : //Wenn es eine Seite nach der aktuellen Seite gibt wird ein Doppelpfeil (») angezeigt, der zur nächsten Seite führt ?>
                <li class="page-item">
                    <a class="page-link" href="<?= $pagination->nextPageURL() ?>">&raquo;</a>
                </li>
            <?php endif ?>

        </ul>
    </nav>
<?php endif ?>