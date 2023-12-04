
<!-- Erzeugt einen kleinen Knopf mit der Beschriftung $knopftext, so dass das
Layout überall konsistent ist-->

<a 
class="btn-sm text-decoration-none stretched-link" 
role="button" 
href="<?= $subpage->url() ?>" 
aria-disabled="false"
<?= isset($neuerTab) && $neuerTab ? "target=\"_blank\" rel=\"noopener\"" : "" //ternary operator
    //Fügt die benötigten Elemente hinzu wenn der Link in einem neuen Tab geöffnet werden soll -> neuerTab also true ist 
?>
>
<?= $knopftext ?>
</a>