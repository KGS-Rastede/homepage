<?php $kategorien = page('navbar')->navbar()->toStructure() ?>
<?php $count = 1 //Wird für die id der Kategorien verwendet, damit diese einmalig bleiben 
?>

<?php if ($kategorien->isNotEmpty()) : //Erst die Grundstruktur für die nav 
?>


    <nav class="navbar navbar-expand-lg fixed-top navbar-light" aria-label="Main navigation">

        <div class="container-fluid">


            <a class="navbar-brand" href="<?= $site->url() ?>">KGS Rastede</a>

            <button class="navbar-toggler p-0 border-0" type="button" id="navbarSideCollapse" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php //Jetzt kommen alle Kategorien
                    snippet('navkategorien', ['items' => $kategorien, 'count' => $count]) ?>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Suche</button>
                </form>
            </div>
        </div>
    </nav>


<?php endif ?>