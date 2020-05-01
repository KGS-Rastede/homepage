<?php snippet('header') ?>

<?php snippet('page-header') ?>




<h2 class="title">
    <?= $page->title() ?>
</h2>

<h5 class="description">
    <?= $page->text() ?>
</h5>

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
            <tr>
                <td><?= $kontakt->position() ?></td>
                <td><?= $kontakt->title() ?></td>
                <td><?= $kontakt->phone() ?></td>
                <td><script type="text/javascript">
                        var mail = "<?= $kontakt->email() ?>";
                        var en = "de";
                        var dom = "kgs-rastede";
                        var at = "@";
                        document.open();
                        document.write(unescape("%3Ca class='GrosserLink' href='mailto:" + mail + at + dom + "." + en + "'%3E" + mail + at + dom + "." + en + "%3C/a%3E"));
                        document.close();
                    </script>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>




<?php snippet('footer') ?>