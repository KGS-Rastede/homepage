<?php snippet('header') ?>
<?php snippet('page-header') ?>

<?php snippet('sidebar') ?>

<?php if ( $page->tickets()->isEmpty() ) : //Falls es keine Tickets mehr gibt soll auch kein Formular angezeigt werden ?>
    <div class="container text-danger">
        <p>Es sind zur Zeit keine Tickets verfügbar. Wir werden schnellstmöglich neue Tickets anlegen.</p>
    </div>
<?php else : ?>
    <?php if ($success) : ?>
        <div class="container">
            <div class="alert success">
                <p><?= $success ?></p>
            </div>
        </div>
    <?php else : ?>
        <div class="container text-danger">
            <?php if (isset($alert['error'])) : ?>
                <div><?= $alert['error'] ?></div>
            <?php endif ?>
        </div>


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

                <button type="submit" name="submit" value="Submit" class="mt-3 btn btn-secondary">WLAN Ticket abschicken...</button>
            </div>


        </form>
    <?php endif ?>
<?php endif ?>

<?php snippet('footer') ?>