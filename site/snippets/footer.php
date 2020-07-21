<!-- es müssen noch 3 divs aus dem Template geschlossen werden -->
</div>
<hr>

</main>

<footer class="container-fluid">
  <div class="row">

    <div class="col-md-2">
      <a href="<?= $site->url() ?>">
        <?php snippet('skripte-im-footer') ?>
      </a>
    </div>

    <div class="col-md-4">
      <h5>Kontakt</h5>
      <ul>
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
      <ul>
        <li><a class="text-muted" href="<?= page('allgemeines/downloads')->url() ?>#schulbuchlisten-1">Schulbuchlisten</a></li>
        <li><a class="text-muted" href="#">Schulordnung</a></li>
        <li><a class="text-muted" href="<?= page('allgemeines/wichtigelinks')->url() ?>">wichtige Links</a></li>
      </ul>
    </div>
    <div class="col-md-3">
      <h5>Über die KGS</h5>
      <ul>
        <li><a class="text-muted" href="<?= page('allgemeines/geschichte')->url() ?>"">Unsere Geschichte</a></li>
        <li><a class="text-muted" href="<?= page('allgemeines/anfahrt')->url() ?>">Anfahrt</a></li>
        <li><a class="text-muted" href="<?= page('allgemeines/impressum')->url() ?>">Impressum</a></li>
        <li><a class="text-muted" href="<?= page('allgemeines/mensa')->url() ?>">Mensa</a></li>
      </ul>
    </div>
  </div>
  <hr>
  <div class="copyright pull-center">
    Copyright &#xA9; <script>
      document.write(new Date().getFullYear())
    </script> KGS Rastede ; All Rights Reserved.
  </div>
</footer>

<?php snippet('skripte-im-footer') ?>



</body>

</html>