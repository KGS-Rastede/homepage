<?php snippet('header') ?>

<?php snippet('page-header') ?>

<?php snippet('kalender_vorbereiten') ?>


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
  <div id='calendar'></div>

  <!-- 
    Jetzt werden zwei Variablen von FullCalender.io überschrieben.
  Durch diese kommt es bei langen Kalendereinträgen zu Zeilenumbrüchen.
   -->
  <style type='text/css'>
    .fc-daygrid-dot-event .fc-event-title {
      white-space: normal !important;
    }

    .fc-h-event .fc-event-title {
      white-space: normal !important;
    }
  </style>
</div>
<!-- <div id='script-warning'>
  <code>public.ics</code> konnte nicht geladen werden
</div>

<div id='loading'>loading...</div>

<div id='calendar'></div> -->

<?php snippet('footer') ?>