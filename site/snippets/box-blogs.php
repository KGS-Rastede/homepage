<h2 class="mt-5 mb-3">Aus dem Schulleben</h2>

<?php if(collection('blogs-startseite')->isNotEmpty()) : //wenn aktuelle Artikel vorhanden sind  ?>
    <div class="row row-cols-1 row-cols-xs-1 row-cols-lg-2 g-4">

        <?php foreach (collection('blogs-startseite') as $subpage){
            snippet('blogkarte', ['subpage' => $subpage]); 
        }?>

    </div>
<?php endif ?>

<a href="<?= page("blogs") ?>">
    <button class="btn btn-secondary mb-5">

        <?php if(collection('blogs-startseite')->isNotEmpty()) : //wenn aktuelle Artikel vorhanden sind ?>
            Weitere Nachrichten aus der Schule &#8594;
        <?php else : //wenn keine aktuellen Artikel vorhanden sind ?>
            Nachrichten aus der Schule &#8594;
        <?php endif ?>
        
    </button>
</a>

