<?php snippet('header') ?>
<?php snippet('page-header') ?>

<?php snippet('sidebar') ?>

<?php if ($success) : ?>
    <div class="container">
        <div class="alert success">
            <p><?= $success ?></p>
        </div>
    </div>
<?php else : ?>
    <?php if (isset($alert['error'])) : ?>
    <div class="container text-danger">
        <div><?= $alert['error'] ?></div>
    </div>
    <?php endif ?>


    <form method="post" action="<?= $page->url() ?>">

        <div class="honeypot">
            <label for="website">Website <abbr title="required">*</abbr></label>
            <input type="website" id="website" name="website" tabindex="-1">
        </div> 

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
                            <?= isset($alert['name']) ? '<span class="alert error text-danger">' . html($alert['name']) . '</span>' : '' ?>
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
                            <?= isset($alert['benutzername']) ? '<span class="alert error text-danger">' . html($alert['benutzername']) . '</span>' : '' ?>
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
                            <?= isset($alert['email']) ? '<span class="alert error text-danger">' . html($alert['email']) . '</span>' : '' ?>
                            <div id="emailHelp" class="form-text">An diese Adresse werden wir das neue Passwort schicken</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <div class="field">                            
                            <label for="klasse" class="form-label">
                            Klasse
                            </label>

                            <select type="form-select" id="klasse" class="form-select" name="klasse" value="<?= $data['klasse'] ?? '' ?>" required>

                                <option selected disabled>Klasse auswählen</option>
                                <?php foreach (page('formulare/klassen')->klassen()->toStructure() as $klasse) : //Das Kirby Feld durchlaufen für alle Einträge ?>
                                <?php if ($klasse->klasse() == '------') : //Die Striche sollen nur als Trennung dienen ?>
                                    <option disabled class='text-muted'><?= $klasse->klasse() ?></option>
                                <?php else : ?>
                                    <option><?= $klasse->klasse() ?></option>
                                <?php endif ?>
                                <?php endforeach ?>
                                
                            </select>
                            <?= isset($alert['klasse']) ? '<span class="alert error text-danger">' . html($alert['klasse']) . '</span>' : '' ?>

                        </div>                        
                    </div>
                </div>
            </div>

            <button type="submit" name="submit" value="Submit" class="mt-3 btn btn-secondary">Neues Passwort anfordern...</button>
        </div>
        
    </form>
<?php endif ?>

<?php snippet('footer') ?>