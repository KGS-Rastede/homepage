<div class="container">
  <nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark">


    <a class="navbar-brand" href="<?= $site->url() ?>">KGS Rastede</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="#">&Uuml;ber die Schule</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= page('kontakte')->url() ?>">Kontakt</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">Fachbereiche</a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="#">&Uuml;bersicht</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Arbeit/Wirtschaft</a>
            <a class="dropdown-item" href="<?= page('Faecher/Sport')->url() ?>">Sport</a>
            <a class="dropdown-item" href="<?= page('Faecher/Physik')->url() ?>">Physik</a>
            <a class="dropdown-item" href="<?= page('Faecher/Biologie')->url() ?>">Biologie</a>
            <a class="dropdown-item" href="<?= page('Faecher/Chemie')->url() ?>">Chemie</a>
            <a class="dropdown-item" href="<?= page('Faecher/Informatik')->url() ?>">Informatik</a>

            <a class="dropdown-item" href="#">Mukubi</a>
            <a class="dropdown-item" href="#">Fremdsprachen</a>
            <a class="dropdown-item" href="#">Deutsch</a>
            <a class="dropdown-item" href="#">Mathematik</a>
          </div>
        </li>
      </ul>
    </div>
  </nav>
</div>