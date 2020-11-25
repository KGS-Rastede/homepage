<?php //nur die Downloads unter Schule, die auf der Startseite angezeigt werden sollen
return function() {

    $downloads = new Files(); 
    foreach (page('allgemeines/wichtigelinks')->Schule()->toFiles() as $schnellverweis) {
        if ($schnellverweis->Startseite() == 'true')
            $downloads = $downloads->add($schnellverweis);
    }
    return $downloads;
}

?>