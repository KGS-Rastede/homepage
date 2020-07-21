<?php snippet('header') ?>

<?php snippet('page-header') ?>





<h5 class="description">
    <?= $page->text() ?>
</h5>

<div class="table-responsive-sm">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Aufgabenbereich</th>
                <th scope="col">Name</th>
                <th scope="col">Telefonnummer</th>
                <th scope="col">Emailadresse</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($page->children() as $kontakt) : ?>
                <?php
                if ($kontakt->fotoansicht() != "sek") continue;
                ?>

                <tr>
                    <td><?= $kontakt->position() ?></td>
                    <td><?= $kontakt->title() ?></td>
                    <td><?= $kontakt->phone() ?></td>
                    <td>
                        <script type="text/javascript">
                            var mail = "<?= $kontakt->Heading() ?>";
                            var en = "de";
                            var dom = "kgs-rastede";
                            var at = "@";
                            document.open();
                            document.write(unescape("%3Ca href='mailto:" + mail + at + dom + "." + en + "'%3E" + mail + at + dom + "." + en + "%3C/a%3E"));
                            document.close();
                        </script>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>


<h1 id="haus">Hausmeister und Schulassistenten</h1>

<div class="table-responsive-sm">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Aufgabenbereich</th>
                <th scope="col">Name</th>
                <th scope="col">Telefonnummer</th>
                <th scope="col">Emailadresse</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($page->children() as $kontakt) : ?>
                <?php
                if ($kontakt->fotoansicht() != "hausmeister") {
                    continue;
                }
                ?>

                <tr>
                    <td><?= $kontakt->position() ?></td>
                    <td><?= $kontakt->title() ?></td>
                    <td><?= $kontakt->phone() ?></td>
                    <td>
                        <script type="text/javascript">
                            var mail = "<?= $kontakt->heading() ?>";
                            var en = "de";
                            var dom = "kgs-rastede";
                            var at = "@";
                            document.open();
                            document.write(unescape("%3Ca href='mailto:" + mail + at + dom + "." + en + "'%3E" + mail + at + dom + "." + en + "%3C/a%3E"));
                            document.close();
                        </script>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>


<?php snippet('footer') ?>