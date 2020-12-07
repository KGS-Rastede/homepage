<?php snippet('header') ?>
<?php snippet('page-header') ?>

<?php snippet('sidebar') ?>

<div class="container">
<a role="button" class="btn btn-outline-warning my-4" href="<?= page('ser/geschaeftsordnung')->url() ?>">
  Hier geht's zur Geschäftsordnung
</a>

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
            <?php foreach ($page->Mitglieder()->toStructure() as $kontakt) : ?>
                <tr>
                    <td><?= $kontakt->position() ?></td>
                    <td><?= $kontakt->name() ?></td>
                    <td><?= $kontakt->phone() ?></td>
                    <td><a href="mailto:<?= $kontakt->email() ?>"><?= $kontakt->email() ?></td></a>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
<br>



<?php
  $items = page('ser/nachrichten')->children()->listed()->flip();

  $list = $items->paginate(6);

  snippet('blog-schlicht', [
    'items' => $list
  ])

?>


<?php
  $pagination = $list->pagination();

  snippet('pagination', [
    'pagination' => $pagination
  ])

?>
</div>

<?php snippet('footer') ?>