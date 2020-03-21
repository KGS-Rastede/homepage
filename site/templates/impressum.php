<?php snippet('header') ?>

<?php snippet('page-header') ?>


<div class="row">
    <div class="col-md-4">
        <h3><b>Anschrift</b></h3>
        <p style="letter-spacing:0.01em; word-spacing:0.3em; line-height:1.3em;"><h5> 
            <?= $page->anschrift() ?>  
            Tel.: <?= $page->telefon()->tel() ?> </br>
            Fax: <?= $page->fax()->tel() ?> </br>
            E-Mail: <span style="text-decoration:underline;"><a href="mailto:<?= $page->email() ?>"><?= $page->email()->email() ?></a></span></br>
        </h5></p>
        <h6>(gem. §5 Telemediengesetz)</h6> 
        <h3><b>Inhaltlich Verantwortlich</b></h3>
        <p style="letter-spacing:0.01em; word-spacing:0.3em; line-height:1.3em;"><h5>
            <?= $page->inhaltlichVerantwortlich()->text() ?>
        </h5></p>       
    </div>
    
    <div class="col-md-4">
        <h3><b>Schulleitung</b></h3>
            <table class="table">
            <tbody>
                <tr>
                    <td class="text-left"><?= $page->schulleiter()->text() ?></td>
                    <td>
                        <?php if ($page->schulleiterGeschlecht() == "frau"): ?>
                            Schulleiterin
                        <?php else: ?>
                            Schulleiter
                        <?php endif ?>
                    </td>
                    <td class="td-actions text-right">
                        <a href="mailto:<?= $page->schulleitermail() ?>">
                            <button type="button" rel="tooltip" class="btn btn-info">
                                <i class="material-icons">mail</i>
                            </button>
                        </a>
                    </td>                
                </tr>
                <tr>
                    <td class="text-left"><?= $page->stellver()->text() ?></td>
                    <td>
                        <?php if ($page->stellverGeschlecht() == "frau"): ?>
                            Stellv. Schulleiterin
                        <?php else: ?>
                            Stellv. Schulleiter
                        <?php endif ?>
                    </td>
                    <td class="td-actions text-right">
                        <a href="mailto:<?= $page->stellvermail() ?>">
                            <button type="button" rel="tooltip" class="btn btn-info">
                                <i class="material-icons">mail</i>
                            </button>
                        </a>
                    </td>                
                </tr>
                <tr>
                    <td class="text-left"><?= $page->didaktischeLeitung()->text() ?></td>
                    <td>
                        <?php if ($page->didaktischeLeitungGeschlecht() == "frau"): ?>
                            Didaktische Leiterin
                        <?php else: ?>
                            Didaktischer Leiter
                        <?php endif ?>
                    </td>
                    <td class="td-actions text-right">
                        <a href="mailto:<?= $page->didaktischeLeitungmail() ?>">
                            <button type="button" rel="tooltip" class="btn btn-info">
                                <i class="material-icons">mail</i>
                            </button>
                        </a>
                    </td>                
                </tr>
            </tbody>
        </table> 
        </br>        
        <h3><b>Schulträger</b></h3>
        <p style="letter-spacing:0.01em; word-spacing:0.3em; line-height:1.3em;">
            <h5><?= $page->schultrager()->text() ?></h5>  
        </p>
    </div>
    <!-- # Texte unter den infos -->
    <div class="col-md-7">
    <?php         
        $items = $page->texte()->toStructure();
       
        foreach ($items as $item): ?>
            <h3><b><?= $item->ueberschrift()->text() ?></b></h3>
            <?= $item->text()->text() ?></br>       
        <?php endforeach ?>
    </div>
</div>


</div>

<?php snippet('footer') ?>


</div>

<?php snippet('footer') ?>