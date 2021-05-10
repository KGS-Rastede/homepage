<?php snippet('header') ?>

<?php snippet('page-header') ?>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar/main.min.css" />
<script src='https://cdn.jsdelivr.net/npm/fullcalendar/main.min.js'></script>
<script src='https://github.com/mozilla-comm/ical.js/releases/download/v1.4.0/ical.js'></script>
<script src='https://cdn.jsdelivr.net/npm/@fullcalendar/icalendar/main.global.js'></script>

<?php include('./assets/kalender/kalender-update.php');
$cache_file = './assets/kalender/cache.txt';
$ics_file = './assets/kalender/public.ics';
$update = new kalender_update($cache_file, $ics_file);
$result = $update->checkForUpdate();
?>


<script>
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      locale: 'de', //Darstellung auf Deutsch
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
      },

      buttonText: {
        today: 'Heute',
        month: 'Monat',
        week: 'Woche',
        day: 'Tag',
      },

      // Samstag und Sonntag verstecken
      hiddenDays: [0, 6],
      firstDay: 1,
      navLinks: true, // can click day/week names to navigate views
      editable: false,
      handleWindowResize: true,

      //Zeigt eine rote Linie an, die die aktuelle Zeit darstellt
      nowIndicator: true,

      //Die Stunden von 20 Uhr bis 07 Uhr morgens müssen nicht
      //angezeigt werden, dahier nie schulische Veranstaltungen sind
      slotMinTime: "07:00:00",
      slotMaxTime: "20:00:00",

      // Kalenderwoche anzeigen
      weekNumbers: true,

      allDayText: "ganztägig",

      noEventsContent: 'Keine Ereignisse anzuzeigen',

      displayEventTime: false, // don't show the time column in list view

      events: {
        /*url: 'https://kgs-rastede.eu/iserv/public/calendar/?key=1bad7fec91a3d07904543f4476774fd1',*/
        url: '<?= $kirby->url('assets') ?>/kalender/public.ics',
        format: 'ics',
        failure: function() {
          document.getElementById('script-warning').style.display = 'block';
        },
        loading: function(bool) {
          document.getElementById('loading').style.display =
            bool ? 'block' : 'none';
        }
      }
    });

    calendar.render();
    calendar.refetchEvents(); //Test
  });
</script>
<div class="container-fluid">

  <?php if ($result == false) : ?>
    <div class="container d-flex justify-content-center">
      <p class="mt-2 text-danger">Der Kalender ist möglicherweise nicht aktuell!</p>
    </div>
  <?php endif ?>
  
  <div id='calendar'></div>
</div>
<!-- <div id='script-warning'>
  <code>public.ics</code> konnte nicht geladen werden
</div>

<div id='loading'>loading...</div>

<div id='calendar'></div> -->

<?php snippet('footer') ?>