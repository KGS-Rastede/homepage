<?php snippet('header') ?>
<?php snippet('page-header') ?>

<?php snippet('sidebar') ?>

<?php if ($success) : ?>
    <div class="alert success">
        <p><?= $success ?></p>
    </div>
<?php else : ?>
    <?php if (isset($alert['error'])) : ?>
        <div><?= $alert['error'] ?></div>
    <?php endif ?>


    <form method="post" action="<?= $page->url() ?>">

        <div class="honeypot">
            <label for="website">Website <abbr title="required">*</abbr></label>
            <input type="website" id="website" name="website" tabindex="-1">
        </div> 


        <div class="container">

            <p>
                Bitte die richtige Adresse aussuchen und auf den Knopf drücken
            </p>

            <div class="row align-items-start">
                <div class="col">
                    <div class="mb-3">
                        <div class="field">
                            <label for="lehrkraft" class="form-label">
                                Lehrer
                            </label>

                            <input type="text" id="lehrkraft" class="form-control" name="lehrkraft" value="<?= $data['lehrkraft'] ?? '' ?>" required>
                            <?= isset($alert['lehrkraft']) ? '<span class="alert error">' . html($alert['lehrkraft']) . '</span>' : '' ?>
                            <div id="nameHelp" class="form-text">'Max Mustermann'</div>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" name="submit" value="Submit" class="ms-3 mt-3 btn btn-secondary">WLAN Voucher abschicken...</button>
        </div>


    </form>
<?php endif ?>

<?php snippet('footer') ?>