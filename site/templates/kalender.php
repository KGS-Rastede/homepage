<?php snippet('header') ?>

<?php snippet('page-header') ?>



<script src='https://unpkg.com/@fullcalendar/google-calendar@4.4.0/main.min.js'></script>



<script>

document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');

  var calendar = new FullCalendar.Calendar(calendarEl, {
    locale: 'de', //Darstellung auf Deutsch
    plugins: [ 'dayGrid', 'list','googleCalendar' ],
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,listWeek'
    },
    buttonText: {
      today:    'Heute',
      month:    'Monat',
      week:     'Woche',
      day:      'Tag',
      list:     'Woche',
    },

    weekNumbers: true, // Kalenderwoche anzeigen
    weekLabel: "Kalenderwoche", // Beschriftung der Kalenderwoche
    displayEventTime: true, // don't show the time column in list view

    googleCalendarApiKey: 'AIzaSyCYHdh89aVp9EA9nh4e_kMDy6ugfVuRHoE',

    events: 'kooperativegesamtschulerastede@gmail.com'

  });

  calendar.render();
});

</script>

<div id='calendar'></div>

<?php snippet('footer') ?>