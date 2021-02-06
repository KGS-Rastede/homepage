<?php snippet('header') ?>

<?php snippet('page-header') ?>


<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.13.0/css/all.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar/main.min.css">


<script src='https://cdn.jsdelivr.net/npm/fullcalendar/main.min.js'></script>


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
      hiddenDays: [0, 6], // Samstag und Sonntag verstecken
      firstDay: 1,
      navLinks: true, // can click day/week names to navigate views
      editable: false,
      eventLimit: true, // allow "more" link when too many events
      eventLimitText: "weitere", // allow "more" link when too many events
      weekNumbers: true, // Kalenderwoche anzeigen
      weekLabel: "KW", // Beschriftung der Kalenderwoche
      allDayText: "ganztägig",
      noEventsContent: 'Keine Ereignisse anzuzeigen',
      displayEventTime: false, // don't show the time column in list view
      
      
      // Wahrscheinlich liegt hier der Fehler.
      // Egal was ich mache, sobald diese Zeile aktiviert ist geht es nicht mehr... 
      // Ursache leider komplett unklar
      // plugins: [iCalendarPlugin],


      // ICS Dokumentation:
      // plugins: [dayGridPlugin, iCalendarPlugin],
      // events: {
      //   url: 'https://mywebsite/icalendar-feed.ics',
      //   format: 'ics'
      // }


      // Der Schulkalender liegt bei https://kgs-rastede.eu/iserv/public/calendar?key=1bad7fec91a3d07904543f4476774fd1
      // Lokal hier:       //   url: '<?= $kirby->url('assets') ?>/kalender/public.ics',

      // events: {
      //   url: '<?= $kirby->url('assets') ?>/kalender/public.ics',
      //   format: 'ics'
      // }

      events: '<?= $kirby->url('assets') ?>/kalender/schuljahresplaner.json'
    });

    calendar.render();
    calendar.refetchEvents(); //Test
  });
</script>

<div class="container mb-5">
  <div id='calendar'></div>
</div>
<?php snippet('footer') ?>