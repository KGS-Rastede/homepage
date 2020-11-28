<?php foreach ($items as $item) : ?>
    <li class="dropdown nav-item">

    <?php if($item->dropdownToggle()->isFalse() ) : $pageLink = $item->kategorieSeite()->toPage() ?>  
        <a href="<?= $pageLink->url() ?>" class="nav-link">
            <?= $item->kategorieTitel()->or($pageLink->title()) ?>            
        </a>

    <?php else : ?>
        
        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
            <?php if ($item->kategorieTitel()->isNotEmpty()) : ?>
                <?= $item->kategorieTitel() ?>
            <?php else : ?>
                Ersatztitel
            <?php endif ?>
        </a>

    <?php endif ?>

        

    <?php $unterpunkteItems = $item->unterpunkte()->toStructure(); ?>

    <?php if ($item->dropdownToggle()->isTrue() && $unterpunkteItems->isNotempty()) : ?>
        <div class="dropdown-menu dropdown-with-icons">
            <?php snippet('navunterpunkte', ['items' => $unterpunkteItems]) ?>
        </div>
    <?php endif ?>

        
    </li>

        
    

<?php endforeach ?>
