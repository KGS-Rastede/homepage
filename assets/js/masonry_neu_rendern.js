(function () {
  //Das masonry layout wird nach dem die Seite vollständig geladen ist einmal neugemacht,
  //sodass sich keine Bilder (die erst später laden und somit die Größe der Blogs verändern) überlappen
  'use strict'

  //das HTML Element erhalten in dem das masonry angewendet werden soll
  const elem = document.getElementById('masonry-element');

  //Masonry definieren und optionen festlegen
  const msnry = new Masonry(elem, {
    //optionen
    percentPosition: true
  });

  //wenn die Seite vollständig geladen ist
  window.onload = function () {
    //masonry einmal neu ausrichten
    msnry.layout();
  }
})()
