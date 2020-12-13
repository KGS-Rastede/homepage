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
        <!-- Muss im CSS noch unsichtbar gemacht werden
            <div class="honeypot">
            <label for="website">Website <abbr title="required">*</abbr></label>
            <input type="website" id="website" name="website" tabindex="-1">
        </div> 
        -->


        <!--  -->

        <div class="container">

            <p>
                Du hast dein Passwort nicht mehr zur Hand?
            </p>
            <p>
                Wir werden es in der Regel bis zum nächsten Arbeitstag zurückzusetzen. Je nach aktueller Situation kann es auch länger dauern.
            </p>

            <div class="row align-items-start">
                <div class="col-md-6">
                    <div class="mb-3">
                        <div class="field">
                            <label for="name" class="form-label">
                                Vorname Nachname
                            </label>
                            <input type="text" id="name" class="form-control" name="name" value="<?= $data['name'] ?? '' ?>" required>
                            <?= isset($alert['name']) ? '<span class="alert error">' . html($alert['name']) . '</span>' : '' ?>
                            <div id="nameHelp" class="form-text">'Max Mustermann'</div>

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <div class="field">
                            <label for="benutzername" class="form-label">
                                Benutzername in IServ
                            </label>
                            <input type="text" id="benutzername" class="form-control" name="benutzername" value="<?= $data['benutzername'] ?? '' ?>" required>
                            <?= isset($alert['benutzername']) ? '<span class="alert error">' . html($alert['benutzername']) . '</span>' : '' ?>
                            <div id="benutzernameHelp" class="form-text">In der Regel 'vorname.nachname'</div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row align-items-start">
                <div class="col-md-6">
                    <div class="mb-3">

                        <div class="field">
                            <label for="email" class="form-label">
                                E-Mail-Adresse
                            </label>
                            <input type="email" id="email" class="form-control" name="email" value="<?= $data['email'] ?? '' ?>" required>
                            <?= isset($alert['email']) ? '<span class="alert error">' . html($alert['email']) . '</span>' : '' ?>
                            <div id="emailHelp" class="form-text">An diese Adresse werden wir das neue Passwort schicken</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="klasse" class="form-label">Klasse</label>
                        <input type="text" id="klasse" class="form-control" name="klasse" value="<?= $data['klasse'] ?? '' ?>" required>
                        <?= isset($alert['klasse']) ? '<span class="alert error">' . html($alert['klasse']) . '</span>' : '' ?>
                        <div id="klasseHelp" class="form-text">z.B. '07A2'</div>
                    </div>
                </div>
            </div>
            <button type="submit" name="submit" value="Submit" class="ms-3 mt-3 btn btn-secondary">neues Passwort anfordern...</button>
        </div>

        <!--  -->
    </form>
<?php endif ?>

<?php snippet('footer') ?>