<footer class='w-full text-left border-t border-grey p-4'>
  <div class="flex">
    <div class="w-2/5">
      <a href="<?= $site->url() ?>">
        <?php snippet('logo-als-svg') ?>
      </a>
    </div>
    <div class="w-1/5">
      <h5 class="font-bold">Kontakt</h5>
      <ul>
        <li><a class="text-muted" href="<?= page('kontakte/schulleitung')->url() ?>">Schulleitung</a></li>
        <li><a class="text-muted" href="<?= page('kontakte/fbl')->url() ?>">Fachbereichsleiter</a></li>
        <li><a class="text-muted" href="<?= page('kontakte/sekretariate')->url() ?>">Sekretariate</a></li>
        <!-- Funktioniert noch nicht
          <li><a class="text-muted" href="<?= page('allgemeines/krankmeldung')->url() ?>">Krankmeldung</a></li> 
        -->
      </ul>
    </div>
    <div class="w-1/5">
      <h5 class="font-bold">Über die KGS</h5>
      <ul>
        <li><a class="text-muted" href="<?= page('allgemeines/geschichte')->url() ?>">Unsere Geschichte</a></li>
        <li><a class="text-muted" href="<?= page('allgemeines/anfahrt')->url() ?>">Anfahrt</a></li>
        <li><a class="text-muted" href="<?= page('allgemeines/impressum')->url() ?>">Impressum</a></li>
        <li><a class="text-muted" href="<?= page('allgemeines/mensa')->url() ?>">Mensa</a></li>
      </ul>
    </div>
    <div class="w-1/5">
      <h5 class="font-bold">Wichtige Downloads</h5>
      <ul class="list-unstyled">
        <li><a class="text-muted" href="<?= page('allgemeines/schulbuchlisten')->url() ?>">Schulbuchlisten</a></li>
        <li><a class="text-muted" href="#">Schulordnung</a></li>
        <li><a class="text-muted" href="<?= page('allgemeines/wichtigelinks')->url() ?>">Wichtige Links</a></li>
      </ul>
    </div>
  </div>

</footer>

</body>

</html>