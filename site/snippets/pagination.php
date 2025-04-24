<?php if ($pagination->hasPages()):

  $range = 5; //Wird für die Länge der bzw. Anzahl der Elemente verwendet. Außerdem zur Berechnung der Extra Seiten: https://getkirby.com/docs/reference/objects/pagination/range
  $extraSeiten = 2; //Die Anzahl der Extraseiten. Also die ersten "paar" und die letzten "paar" Seiten
  $gesamtSeitenzahl = $pagination->pages();
  $aktuelleSeite = $pagination->page();
?>


  <div class="text-center my-2 dark:text-gray-100">

    <nav class="hidden sm:inline-flex">
      <?php if (
        $pagination->hasPrevPage()
      ): //Wenn es eine Seite vor der aktuellen Seite gibt wird ein Doppelpfeil («) angezeigt, der zur vorherigen Seite führt
      ?>
        <a href="<?= $pagination->prevPageURL() ?>" class="-mr-px inline-flex items-center justify-center space-x-2 rounded-l-lg border border-gray-200 bg-slate-200 px-4 py-2 font-semibold leading-6 text-gray-900 hover:z-1 hover:border-gray-300 hover:text-gray-900 hover:shadow-sm focus:z-1 focus:ring focus:ring-gray-300 focus:ring-opacity-25 active:z-1 active:border-gray-200 active:shadow-none dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 dark:hover:border-gray-500 dark:hover:text-gray-200 dark:focus:ring-gray-600 dark:focus:ring-opacity-40 dark:active:border-gray-600">
          <svg class="hi-mini hi-arrow-left -mx-1.5 inline-block h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M17 10a.75.75 0 01-.75.75H5.612l4.158 3.96a.75.75 0 11-1.04 1.08l-5.5-5.25a.75.75 0 010-1.08l5.5-5.25a.75.75 0 111.04 1.08L5.612 9.25H16.25A.75.75 0 0117 10z" clip-rule="evenodd" />
          </svg>
        </a>
      <?php endif; ?>


      <?php for ($i = 1; $i <= $extraSeiten; $i++): ?>
        <?php if (
          $i <
          $aktuelleSeite - $range / 2 + 0.5
        ): //d-none d-sm-block => auf dem Handy nicht anzeigen
        ?>

          <a href="<?= $pagination->pageURL(
                      $i,
                    ) ?>" class="-mr-px inline-flex items-center justify-center space-x-2 border border-gray-200 bg-slate-200 px-4 py-2 font-semibold leading-6 text-gray-900 hover:z-1 hover:border-gray-300 hover:text-gray-900 hover:shadow-sm focus:z-1 focus:ring focus:ring-gray-300 focus:ring-opacity-25 active:z-1 active:border-gray-200 active:shadow-none dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 dark:hover:border-gray-500 dark:hover:text-gray-200 dark:focus:ring-gray-600 dark:focus:ring-opacity-40 dark:active:border-gray-600">
            <?= $i ?>
          </a>

        <?php endif; ?>
      <?php endfor; ?>

      <?php if (
        $extraSeiten + 1 <
        $aktuelleSeite - $range / 2 + 0.5
      ): //Es gibt Elemente zwischen der letzten ExtraSeite und den Seiten,
        //die normal angzeigt werden. +0.5 siehe oben

        //d-none d-sm-block => auf dem Handy nicht anzeigen
      ?>
        <a href="" class="-mr-px inline-flex items-center justify-center space-x-2 border border-gray-200 bg-slate-200 px-4 py-2 font-semibold leading-6 text-gray-900 hover:z-1 hover:border-gray-300 hover:text-gray-900 hover:shadow-sm focus:z-1 focus:ring focus:ring-gray-300 focus:ring-opacity-25 active:z-1 active:border-gray-200 active:shadow-none dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 dark:hover:border-gray-500 dark:hover:text-gray-200 dark:focus:ring-gray-600 dark:focus:ring-opacity-40 dark:active:border-gray-600">
          ...
        </a>
      <?php endif; ?>


      <!-- Hier nun die mittleren Elemente -->
      <?php foreach ($pagination->range($range) as $r): ?>
        <a href="<?= $pagination->pageURL(
                    $r,
                  ) ?>" class="-mr-px <?= $aktuelleSeite === $r
                                        ? 'bg-slate-300'
                                        : 'bg-slate-200' ?> inline-flex items-center justify-center space-x-2 border border-gray-200 px-4 py-2 font-semibold leading-6 text-gray-900 hover:z-1 hover:border-gray-300 hover:text-gray-900 hover:shadow-sm focus:z-1 focus:ring focus:ring-gray-300 focus:ring-opacity-25 active:z-1 active:border-gray-200 active:shadow-none dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 dark:hover:border-gray-500 dark:hover:text-gray-200 dark:focus:ring-gray-600 dark:focus:ring-opacity-40 dark:active:border-gray-600">
          <?= $r ?>
        </a>


      <?php endforeach;
      /* Hier steckt hinter:
                Wenn page() identisch ist mit $r schreibe aria-current (also aktuelle Seite),
                ansonsten mache '', also füge nichts ein. Das ist eine extreme Abkürzung.

                Damit wird im Endeffekt erreicht, dass mit nur einer Zeile die aktuelle Seite
                markiert wird 
                */
      ?>


      <?php if (
        $gesamtSeitenzahl - $extraSeiten >
        $aktuelleSeite + $range / 2
      ): //Es gibt Elemente zwischen der letzten normalen Seite und der ersten extra Seite
      ?>
        <div class="-mr-px flex items-center justify-center border border-gray-200 bg-slate-200 px-4 text-gray-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300">
          ...
        </div>
      <?php endif; ?>

      <?php for (
        $i = $gesamtSeitenzahl - ($extraSeiten - 1);
        $i <= $gesamtSeitenzahl;
        $i++
      ): ?>
        <?php if ($i > $aktuelleSeite + $range / 2): ?>

          <a href="<?= $pagination->pageURL(
                      $i,
                    ) ?>" class="-mr-px inline-flex items-center justify-center space-x-2 border border-gray-200 bg-slate-200 px-4 py-2 font-semibold leading-6 text-gray-900 hover:z-1 hover:border-gray-300 hover:text-gray-900 hover:shadow-sm focus:z-1 focus:ring focus:ring-gray-300 focus:ring-opacity-25 active:z-1 active:border-gray-200 active:shadow-none dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 dark:hover:border-gray-500 dark:hover:text-gray-200 dark:focus:ring-gray-600 dark:focus:ring-opacity-40 dark:active:border-gray-600">
            <?= $i ?>
          </a>
        <?php endif; ?>
      <?php endfor; ?>

      <?php if (
        $pagination->hasNextPage()
      ): //Wenn es eine Seite nach der aktuellen Seite gibt wird ein Doppelpfeil (») angezeigt, der zur nächsten Seite führt
      ?>
        <a href="<?= $pagination->nextPageURL() ?>" class="inline-flex items-center justify-center space-x-2 rounded-r-lg border border-gray-200 bg-slate-200 px-4 py-2 font-semibold leading-6 text-gray-900 hover:z-1 hover:border-gray-300 hover:text-gray-900 hover:shadow-sm focus:z-1 focus:ring focus:ring-gray-300 focus:ring-opacity-25 active:z-1 active:border-gray-200 active:shadow-none dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 dark:hover:border-gray-500 dark:hover:text-gray-200 dark:focus:ring-gray-600 dark:focus:ring-opacity-40 dark:active:border-gray-600">
          <svg class="hi-mini hi-arrow-right -mx-1.5 inline-block h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M3 10a.75.75 0 01.75-.75h10.638L10.23 5.29a.75.75 0 111.04-1.08l5.5 5.25a.75.75 0 010 1.08l-5.5 5.25a.75.75 0 11-1.04-1.08l4.158-3.96H3.75A.75.75 0 013 10z" clip-rule="evenodd" />
          </svg>
        </a>
      <?php endif; ?>

    </nav>
  </div>
<?php
endif; ?>