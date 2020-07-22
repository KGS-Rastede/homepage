<nav>
    <ul class="pagination">

        <?php if ($pagination->hasPrevPage()) : ?>
            <li class="page-item">
                <a class="page-link" href="<?= $pagination->prevPageURL() ?>">‹</a>
            </li>
        <?php else : ?>
            <li>
                <span>‹</span>
            </li>
        <?php endif ?>

        <!-- Hier nun die mittleren Elemente -->

        <?php foreach ($pagination->range(10) as $r) : ?>
            <li class="page-item <?= $pagination->page() === $r ? 'active' : '' ?>">
                <!-- Hier steckt hinter:
        Wenn page() identisch ist mit $r schreibe aria-current (also aktuelle Seite),
        ansonsten mache '', also füge nichts ein. Das ist eine extreme Abkürzung.

        Damit wird im Endeffekt erreicht, dass mit nur einer Zeile die aktuelle Seite
        markiert wird
      -->
                <a class="page-link" <?= $pagination->page() === $r ? 'aria-current="page"' : '' ?> href="<?= $pagination->pageURL($r) ?>">
                    <?= $r ?>
                </a>
            </li>
        <?php endforeach ?>

        <?php if ($pagination->hasNextPage()) : ?>
            <li class="page-item">
                <a class="page-link" href="<?= $pagination->nextPageURL() ?>">›</a>
            </li>
        <?php else : ?>
            <li class="page-item">
                <span>›</span>
            </li>
        <?php endif ?>

    </ul>
</nav>