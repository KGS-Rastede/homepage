
<!-- Erzeugt einen kleinen Knopf mit der Beschriftung $knopftext, so dass das
Layout überall konsistent ist-->

<a 
class="btn-sm btn-primary text-decoration-none stretched-link" 
role="button" 
href="<?= $subpage->url() ?>" 
aria-disabled="false">
<?= $knopftext ?>
</a>