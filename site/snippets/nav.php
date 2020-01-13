<nav class="navbar navbar-expand-lg navbar-fixed-top navbar-light bg-light">



  <a class="navbar-brand" href="<?= $site->url() ?>">KGS Rastede</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
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
        <a class="nav-link dropdown-toggle" href="<?= page('Faecher')->url() ?>" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          aus den Fachbereichen
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="<?= page('blogs')->children()->listed()->filterBy('tags', 'NTW', ',')  ?>">NTW</a>
          <a class="dropdown-item" href="#">Wirtschaft</a>
          <a class="dropdown-item" href="#">Sport</a>
        </div>
      </li>
    </ul>
  </div>
</nav>