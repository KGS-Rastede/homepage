<?php snippet('header') ?>
<?php snippet('page-header') ?>

<?php snippet('sidebar') ?>

<?php if ($page->tickets()->isEmpty()) : //Falls es keine Tickets mehr gibt soll auch kein Formular angezeigt werden 
?>
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

        <div class="col-md-6">
          <div class="mb-3">
            <div class="field">
              <label for="emailadresse" class="form-label">
                EMailadresse*
              </label>

              <select type="form-select" id="emailadresse" class="form-select" name="emailadresse" value="<?= $data['emailadresse'] ?? '' ?>" required>

                <option selected disabled>EMailadresse auswählen</option>
                <?php foreach (page('formulare/emailadressen')->Emailadressen()->toStructure() as $email) : //Das Kirby Feld durchlaufen für alle Einträge 
                ?>
                  <option><?= $email->emailadresse() ?></option>
                <?php endforeach ?>

              </select>
              <?= isset($alert['emailadresse']) ? '<span class="alert error text-danger">' . html($alert['emailadresse']) . '</span>' : '' ?>

            </div>
          </div>
        </div>

        <button type="submit" name="submit" value="Submit" class="mt-3 btn btn-secondary">WLAN Ticket abschicken...</button>
      </div>


    </form>
  <?php endif ?>
<?php endif ?>

<?php snippet('footer') ?>