<?php snippet('header') ?>
<?php snippet('page-header') ?>

<div class="container">
    <?php if ($page->heading()->isNotEmpty()): ?>
        <h2><?= $page->heading() ?></h2>
    <?php endif; ?>

    <?php if ($page->textBefore()->isNotEmpty()): ?>
        <div class="container">
            <?= $page->textBefore()->kirbyText() ?>
        </div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <th>Jahr</th>
                <th>Spender</th>
                <th>Betrag</th>
            </thead>
            <tbody>
                <?php foreach ($page->children() as $l) : ?>
                    <tr>
                        <td>
                            <?= $l->datum() ?>
                        </td>
                        <td>
                            <?= $l->spender() ?>
                        </td>
                        <td>
                            <?= $l->betrag() ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>

    <?php if ($page->textAfter()->isNotEmpty()): ?>
        <div class="container">
            <?= $page->textAfter()->kirbyText() ?>
        </div>
    <?php endif; ?>
</div>

<?php snippet('sidebar') ?>

<?php snippet('footer') ?>
