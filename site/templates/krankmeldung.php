<?php snippet('header') ?>
<?php snippet('page-header') ?>

<?php snippet('sidebar') ?>

<!-- Anleitung: https://getkirby.com/docs/guide/emails -->

<?php if ($success) : ?>
  <div class="alert success">
    <p><?= $success ?></p>
  </div>
<?php else : ?>
  <?php if (isset($alert['error'])) : ?>
    <div><?= $alert['error'] ?></div>
  <?php endif ?>


  <form method="post" action="<?= $page->url() ?>">
  <!-- 
    Muss im CSS noch unsichtbar gemacht werden
            <div class="honeypot">
            <label for="website">Website <abbr title="required">*</abbr></label>
            <input type="website" id="website" name="website" tabindex="-1">
        </div> 
  -->

  <div class="container">

    <p>
      Sie möchten ihr Kind krankmelden?
    </p>
    <p>
      Bitte füllen Sie folgende Felder aus, die Klassenlehrkraft wird dann informiert.
    </p>

    <div class="row align-items-start">
      <div class="col-12">
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


      <div class="mb-3">

        <div class="field">
          <label for="email" class="form-label">
            E-Mail-Adresse
          </label>
          <input type="email" id="email" class="form-control" name="email" value="<?= $data['email'] ?? '' ?>" required>
          <?= isset($alert['email']) ? '<span class="alert error">' . html($alert['email']) . '</span>' : '' ?>
          <div id="emailHelp" class="form-text">Für Rückfragen</div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="mb-3">
          <div class="field">
            <label for="klassenlehrer" class="form-label">Klassenlehrer</label>
            <input type="text" id="klassenlehrer" class="form-control" name="klassenlehrer" value="<?= $data['klassenlehrer'] ?? '' ?>" required>
            <?= isset($alert['klassenlehrer']) ? '<span class="alert error">' . html($alert['klassenlehrer']) . '</span>' : '' ?>
            <div id="klassenlehrerHelp" class="form-text">z.B. 'Herr Mustermann'</div>
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
              <option selected>unbekannt</option>
              <option>05a2</option>
              <option>05a3</option>
              <option>05b1</option>
              <option>05b2</option>
              <option>05b3</option>
              <option>05c2</option>
              <option>05c3</option>
              <option>06a1</option>
              <option>06a2</option>
              <option>06a3</option>
              <option>06b1</option>
              <option>06b2</option>
              <option>06b3</option>
              <option>06c2</option>
              <option>06c3</option>
              <option>07a1</option>
              <option>07a2</option>
              <option>07a3</option>
              <option>07b1</option>
              <option>07b2</option>
              <option>07b3</option>
              <option>07c2</option>
              <option>07c3</option>
              <option>08a1</option>
              <option>08a2</option>
              <option>08a3</option>
              <option>08b1</option>
              <option>08b2</option>
              <option>08b3</option>
              <option>08c2</option>
              <option>08c3</option>
            </select>
            <?= isset($alert['klasse']) ? '<span class="alert error">' . html($alert['klasse']) . '</span>' : '' ?>
            
          </div>
        </div>
      </div>
    </div>
    <button type="submit" name="submit" value="Submit" class="ms-3 mt-3 btn btn-secondary">Krankmeldung losschicken...</button>
  </div>

  <!--  -->
  </form>
<?php endif ?>

<?php snippet('footer') ?>