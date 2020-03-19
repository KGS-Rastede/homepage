<?php snippet('header') ?>

<?php snippet('page-header') ?>

<style>
  #calendar {
    max-width: 900px;
    margin: 0 auto;
  }
</style>
<script src='https://unpkg.com/@fullcalendar/daygrid@4.4.0/main.min.js'></script>

<script src='https://unpkg.com/@fullcalendar/list@4.4.0/main.min.js'></script>

<script src='https://unpkg.com/@fullcalendar/google-calendar@4.4.0/main.min.js'></script>



<script>

document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');

  var calendar = new FullCalendar.Calendar(calendarEl, {
    plugins: [ 'dayGrid', 'list', 'googleCalendar' ],
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

    displayEventTime: false, // don't show the time column in list view

    // THIS KEY WON'T WORK IN PRODUCTION!!!
    // To make your own Google API key, follow the directions here:
    // http://fullcalendar.io/docs/google_calendar/
    googleCalendarApiKey: 'AIzaSyCYHdh89aVp9EA9nh4e_kMDy6ugfVuRHoE',

    // US Holidays
    events: 'kooperativegesamtschulerastede@gmail.com',

    eventClick: function(arg) {

      // opens events in a popup window
      window.open(arg.event.url, '_blank', 'width=700,height=600');

      // prevents current tab from navigating
      arg.jsEvent.preventDefault();
    }

  });

  calendar.render();
});

</script>

<div id='calendar'></div>

<?php snippet('footer') ?>