<?php snippet('header') ?>

<?php snippet('page-header') ?>


<link href='<?= $kirby->url('assets') ?>/js/plugins/main.css' rel='stylesheet' />


<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.13.0/css/all.css">


<script src='<?= $kirby->url('assets') ?>/js/plugins/main.js'></script>


<script>
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      locale: 'de', //Darstellung auf Deutsch
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
      },

      buttonText: {
        today: 'Heute',
        month: 'Monat',
        week: 'Woche',
        day: 'Tag',
        list: 'Monatsliste',
      },
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