<?php $kategorien = page('navbar')->navbar()->toStructure() ?>
<?php $count = 1 //Wird für die id der Kategorien verwendet, damit diese einmalig bleiben 
?>

<?php if ($kategorien->isNotEmpty()) : //Erst die Grundstruktur für die nav 
?>


    <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-secondary" aria-label="Main navigation">

        <div class="container-fluid">
            <!-- Hier fehlt noch das Logo -->


            <a class="navbar-brand" href="<?= $site->url() ?>">KGS Rastede</a>

            <button class="navbar-toggler" type="button" id="navbarSideCollapse" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php //Jetzt kommen alle Kategorien
                    snippet('navkategorien', ['items' => $kategorien, 'count' => $count]) ?>
                </ul>
                <form class="d-flex" action="search">
                    <input class="form-control me-2" type="text" placeholder="Suche" name="q" <button type="submit"></button>
                </form>


            </div>
        </div>
    </nav>


<?php endif ?>