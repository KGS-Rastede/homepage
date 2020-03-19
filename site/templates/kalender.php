<?php snippet('header') ?>

<?php snippet('page-header') ?>

<style>
  #calendar {
    max-width: 900px;
    margin: 0 auto;
  }
</style>

<script src='https://unpkg.com/@fullcalendar/google-calendar@4.4.0/main.min.js'></script>



<script>

document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');

  var calendar = new FullCalendar.Calendar(calendarEl, {
    plugins: [ 'dayGrid', 'list','googleCalendar' ],
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,listYear'
    },
    buttonText: {
      today:    'Heute',
      month:    'Monat',
      week:     'Woche',
      day:      'Tag',
      list:     'Liste'
    },

    displayEventTime: true, // don't show the time column in list view

    googleCalendarApiKey: 'AIzaSyCYHdh89aVp9EA9nh4e_kMDy6ugfVuRHoE',

    events: 'kooperativegesamtschulerastede@gmail.com'

  });

  calendar.render();
});

</script>

<div id='calendar'></div>

<?php snippet('footer') ?>