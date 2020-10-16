<div class="card mb-3 mt-3">

    <!-- Jetzt folgen die als 'Topartikel' getaggte Blogs
          Die tauchen hier immer auch, egal welches Datumsbereich
          jeweils eingestellt ist
         -->
    <h1 class="ml-3">Aktuell im Fokus</h1>
    <div class="container-fluid">
        <?php $index = 0;
        foreach (page('blogs')
            ->children()
            ->flip() as $subpage) : $index++ ?>
            <?php

            // Ist es ein Topartikel?
            if (
                in_array("Topartikel", $subpage->tags()->split())

                // ist der Artikel noch aktuell?
                and ($subpage->datumStartseite()->toDate('Y-m-d-H-i-s') >= date('Y-m-d-H-i-s'))

            ) {
                snippet('topartikel', ['subpage' => $subpage]);
            }
            ?>
        <?php endforeach ?>
    </div>
</div>