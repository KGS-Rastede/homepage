<hr>

</main>

<footer class="container-fluid">
  <div class="row">

    <div class="col-md-2">
      <a href="<?= $site->url() ?>">
        <?= asset('assets/bilder/logo.svg')->read() ?>
      </a>
    </div>

    <div class="col-md-4">
      <h5>Kontakt</h5>
      <ul class="list-unstyled">
        <li><a class="text-muted" href="<?= page('kontakte/schulleitung')->url() ?>">Schulleitung</a></li>
        <li><a class="text-muted" href="<?= page('kontakte/fbl')->url() ?>">Fachbereichsleiter</a></li>
        <li><a class="text-muted" href="<?= page('kontakte/sekretariate')->url() ?>">Sekretariate</a></li>
        <!-- Funktioniert noch nicht
          <li><a class="text-muted" href="<?= page('allgemeines/krankmeldung')->url() ?>">Krankmeldung</a></li> 
        -->
      </ul>
    </div>
    <div class="col-md-3">
      <h5>Wichtige Downloads</h5>
      <ul class="list-unstyled">
        <li><a class="text-muted" href="<?= page('allgemeines/schulbuchlisten')->url() ?>">Schulbuchlisten</a></li>
        <li><a class="text-muted" href="<?= page('allgemeines/schulordnung')->url() ?>">Schulordnung</a></li>
        <li><a class="text-muted" href="<?= page('allgemeines/wichtigelinks')->url() ?>">Informationen und Formulare</a></li>
      </ul>
    </div>
    <div class="col-md-3">
      <h5>Über die KGS</h5>
      <ul class="list-unstyled">
        <li><a class="text-muted" href="<?= page('schule/geschichte')->url() ?>">Unsere Geschichte</a></li>
        <li><a class="text-muted" href="<?= page('allgemeines/anfahrt')->url() ?>">Anfahrt</a></li>
        <li><a class="text-muted" href="<?= page('allgemeines/impressum')->url() ?>">Impressum</a></li>
        <li><a class="text-muted" href="https://www.opc-asp.de/kgs-rastede/menuplan.php?VMP" target="_blank">Mensa</a></li>
      </ul>
    </div>
  </div>
  <hr>
  <div class="row">
    <div class="col-6">
      Copyright &#xA9; <script>
        document.write(new Date().getFullYear())
      </script> KGS Rastede ; All Rights Reserved.
    </div>
  </div>
</footer>

<?php snippet('skripte-im-footer') ?>



</body>

</html>