<?php snippet('header'); ?>
<?php snippet('page-header'); ?>

<?php snippet('kalender_vorbereiten'); ?>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Auf schmalen Bildschirmen ist das Monatsraster kaum lesbar,
    // dort startet der Kalender als Liste.
    var schmal = window.matchMedia('(max-width: 767px)').matches;

    var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
      locale: 'de',
      initialView: schmal ? 'listMonth' : 'dayGridMonth',
      height: schmal ? 'auto' : undefined,
      // Auf dem Handy nur Blättern und Titel, sonst ist die Leiste zu breit
      headerToolbar: schmal ? {
        left: 'prev',
        center: 'title',
        right: 'next'
      } : {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
      },

      // Samstag und Sonntag ausblenden
      hiddenDays: [0, 6],
      firstDay: 1,
      navLinks: true, // Klick auf Tag oder Woche öffnet diese Ansicht
      nowIndicator: true, // rote Linie für die aktuelle Uhrzeit
      weekNumbers: true,

      // Zwischen 20 und 7 Uhr gibt es keine schulischen Termine
      slotMinTime: '07:00:00',
      slotMaxTime: '20:00:00',

      // Im Monatsraster nur die Titel, in Liste und Woche mit Uhrzeit
      views: {
        dayGridMonth: { displayEventTime: false }
      },

      allDayText: 'ganztägig',
      noEventsContent: 'Keine Termine',

      // Termine aus IServ, aufbereitet von site/plugins/kalender
      events: {
        url: '<?= url('kalender.json') ?>',
        failure: function() {
          document.getElementById('script-warning').hidden = false;
        }
      },
      loading: function(bool) {
        document.getElementById('loading').hidden = !bool;
      }
    });

    calendar.render();
  });
</script>

<main>
  <div class="p-1 md:p-3 lg:px-8 mb-2">
    <p id="script-warning" hidden class="mb-2 text-red-700">Der Kalender konnte nicht geladen werden.</p>
    <p id="loading" hidden class="mb-2 text-slate-500">Termine werden geladen …</p>
    <div id="calendar"></div>
  </div>
</main>

<?php snippet('footertw'); ?>
