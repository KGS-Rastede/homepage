<?php foreach ($items as $item) : //Es werden alle Unterpunkte durchgegangen ?>

    <li>
    
    <?php if ($pageLink = $item->pageLink()->toPage()) : //----------- Wenn es eine interne Seite ist --------------- ?>

        <a class="dropdown-item text-umbruch text-sm-kein-umbruch" href="<?= $pageLink->url()?>">
            <div class="d-flex">            
               <i class="bi bi-<?= $item->icon() ?>"></i>
                
                <div class="col ms-1 ">
                    <?= $item->linkTitle()->or($pageLink->title()) //Entweder den eingegebenen Titel oder als Fallback den Titel der Seite ?>
                </div>
            </div>
        </a>

    <?php elseif ($item->externalLink()->isNotEmpty()) : // --------- Wenn es eine externe Seite ist ---------- ?>

        <a class="dropdown-item text-umbruch text-sm-kein-umbruch" href="<?= $item->externalLink() //Dieser Teil kommt bei Bildschirm schmaler als md ?>">
            <div class="d-flex">   
                <i class="bi bi-<?= $item->icon() ?>"></i>

                <div class="col ms-1">
                    <?= $item->linkTitle()->or( Url::short($item->externalLink()->value()) ) //Entweder den eingegebenen Titel oder als Fallback den Titel der externen Seite ?>
                </div>
            </div>            
        </a>

    <?php endif ?>

    <?php if ($item->trennstrich()->isTrue()) : ?>
        <div class="dropdown-divider"></div>
    <?php endif ?>

    </li>

<?php endforeach ?>
