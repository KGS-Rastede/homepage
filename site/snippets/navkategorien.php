<?php foreach ($items as $item) :  //Es werden alle Kategorien durchgegangen ?>
    <li class="dropdown nav-item">

    <?php if($item->dropdownToggle()->isFalse() ) : $pageLink = $item->kategorieSeite()->toPage() //Wenn die Kategorie ein direkter Link ist ?>  
        <a href="<?= $pageLink->url() ?>" class="nav-link">
            <?= $item->kategorieTitel()->or($pageLink->title()) //Titel der Seite als Fallback ?>            
        </a>

    <?php else : //Wenn die Kategorie eine mit Unterpunkten sein soll ?>        
        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
            <?php if ($item->kategorieTitel()->isNotEmpty()) : //Wenn ein Titel für die Kategorie vorhanden ist ?>
                <?= $item->kategorieTitel() ?>
            <?php else : //Wenn kein Titel angegeben wurde ?>
                Ersatztitel
            <?php endif ?>
        </a>
    <?php endif ?>
        

    <?php $unterpunkteItems = $item->unterpunkte()->toStructure(); ?>

    <?php if ($item->dropdownToggle()->isTrue() && $unterpunkteItems->isNotempty()) : //Wenn die Kategorie Unterpunkte besitzt ?>
        <div class="dropdown-menu dropdown-with-icons">
            <?php //Jetzt kommen alle Unterpunkte in die Kategorie
                snippet('navunterpunkte', ['items' => $unterpunkteItems]) ?>
        </div>
    <?php endif ?>
        
    </li>    

<?php endforeach ?>
