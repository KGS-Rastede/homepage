<?php snippet('header') ?>
<?php snippet('page-header') ?>
<?php snippet('sidebar') ?>

<!-- Anleitung: https://getkirby.com/docs/guide/emails -->

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
        Um ihr Kind krankzumelden, füllen sie bitte die unten stehenden Felder aus, die Klassenlehrkraft wird dann umgehend informiert.
      </p>

      <div class="row align-items-start">

        

        <div class="col-12">
          <div class="mb-3">
            <div class="field">
              <label for="name" class="form-label">
                Vorname Nachname*
              </label>
              <input type="text" id="name" class="form-control" name="name" value="<?= $data['name'] ?? '' ?>" required>
              <?= isset($alert['name']) ? '<span class="alert error text-danger">' . html($alert['name']) . '</span>' : '' ?>
              <div id="nameHelp" class="form-text">Schülername z.B. 'Max Mustermann'</div>

            </div>
          </div>
        </div>


        <div class="col-md-6">
          <div class="mb-3">
            <div class="field">
              <label for="email" class="form-label">
                E-Mail-Adresse*
              </label>
              <input type="email" id="email" class="form-control" name="email" value="<?= $data['email'] ?? '' ?>" required>
              <?= isset($alert['email']) ? '<span class="alert error text-danger">' . html($alert['email']) . '</span>' : '' ?>
              <div id="emailHelp" class="form-text">Für Rückfragen</div>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="mb-3">
            <div class="field">
              <label for="tel" class="form-label">
                Telefonnummer*
              </label>
              <input type="tel" id="tel" class="form-control" name="tel" value="<?= $data['tel'] ?? '' ?>" required>
              <?= isset($alert['tel']) ? '<span class="alert error text-danger">' . html($alert['tel']) . '</span>' : '' ?>
              <div id="telHelp" class="form-text">Für Rückfragen</div>
            </div>
          </div>
        </div>


        <div class="col-md-6">
          <div class="mb-3">
            <div class="field">
              <label for="klasse" class="form-label">
                Klassenlehrer:in*
              </label>

              <select type="form-select" id="klasse" class="form-select" name="klasse" value="<?= $data['klasse'] ?? '' ?>" required>   

                <option selected disabled>Klassenlehrer:in auswählen</option>

                <?php foreach ($site->find('lehrer')->children() as $lehrer) : ?>
                  <option><?= $lehrer->name() ?></option>
                <?php endforeach ?>

              </select>
              <?= isset($alert['klassenlehrer']) ? '<span class="alert error text-danger">' . html($alert['klassenlehrer']) . '</span>' : '' ?>
              
            </div>
          </div>
        </div>


        <div class="col-md-6">
          <div class="mb-3">
            <div class="field">
              <label for="klasse" class="form-label">
                Klasse*
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

        <div class="mb-3">
          <div class="field">
            <label for="nachricht" class="form-label">
              Nachricht
            </label>
            
            <textarea class="form-control" id="nachricht" name="nachricht" placeholder="max. 200 Zeichen" maxlength="200" value="<?= $data['nachricht'] ?? '' ?>" style="height: 70px"></textarea>
            <?= isset($alert['nachricht']) ? '<span class="alert error text-danger">' . html($alert['nachricht']) . '</span>' : '' ?>
            <div id="nachrichtHelp" class="form-text">Es kann eine Nachricht in besonderen Fällen oder bei längerer Krankmeldung angefügt werden</div>
          </div>
        </div>

        <div class="mb-3">
          <div class="form-text">
            Felder mit einem * sind Pflichtfelder
          </div>
        </div>

      </div>
      <button type="submit" name="submit" value="Submit" class="mt-3 btn btn-primary">Krankmeldung übermitteln</button>
    </div>

    
  </form>

  

<?php endif ?>





  
<?php snippet('footer') ?>
