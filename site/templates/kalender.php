<?php snippet('header') ?>

<?php snippet('page-header') ?>


<link href='<?= $kirby->url('assets') ?>/js/packages/core/main.css' rel='stylesheet' />
<link href='<?= $kirby->url('assets') ?>/js/packages/daygrid/main.css' rel='stylesheet' />
<link href='<?= $kirby->url('assets') ?>/js/packages/timegrid/main.css' rel='stylesheet' />
<link href='<?= $kirby->url('assets') ?>/js/packages/list/main.css' rel='stylesheet' />
<link href='<?= $kirby->url('assets') ?>/js/packages/bootstrap/main.css' rel='stylesheet' />

<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.13.0/css/all.css">


<script src='<?= $kirby->url('assets') ?>/js/packages/core/main.js'></script>
<script src='<?= $kirby->url('assets') ?>/js/packages/interaction/main.js'></script>
<script src='<?= $kirby->url('assets') ?>/js/packages/daygrid/main.js'></script>
<script src='<?= $kirby->url('assets') ?>/js/packages/timegrid/main.js'></script>
<script src='<?= $kirby->url('assets') ?>/js/packages/list/main.js'></script>
<script src='<?= $kirby->url('assets') ?>/js/packages/bootstrap/main.js'></script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      locale: 'de', //Darstellung auf Deutsch
      plugins: ['list', 'dayGrid', 'bootstrap'],
      themeSystem: 'bootstrap',
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth, dayGridWeek, dayGridDay, listMonth'
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
      noEventsMessage: "Keine Ereignisse anzuzeigen",
      displayEventTime: true, // don't show the time column in list view
      events: '<?= $kirby->url('assets') ?>/kalender/schulkalender.json'
    });

    calendar.render();
    calendar.refetchEvents(); //Test
  });
</script>

<div id='calendar'></div>

<?php snippet('footer') ?>