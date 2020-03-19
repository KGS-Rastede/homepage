<?php snippet('header') ?>

<?php snippet('page-header') ?>

<style>
  #calendar {
    max-width: 900px;
    margin: 0 auto;
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      plugins: ['interaction', 'dayGrid', 'timeGrid', 'list'],
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
      },
      defaultDate: '2020-02-12',
      navLinks: true, // can click day/week names to navigate views

      weekNumbers: true,
      weekNumbersWithinDays: true,
      weekNumberCalculation: 'ISO',

      editable: true,
      eventLimit: true, // allow "more" link when too many events

      // Gültiges JSON ist so aufgebaut: 
      // [
      //   {
      //     title: 'All Day Event',
      //     start: '2020-02-01'
      //   },
      //   {
      //     title: 'Long Event',
      //     start: '2020-02-07',
      //     end: '2020-02-10'
      //   }
      // ]

      //   events: [{
      //       title: 'All Day Event',
      //       start: '2020-02-01'
      //     },
      //     {
      //       title: 'Long Event',
      //       start: '2020-02-07',
      //       end: '2020-02-10'
      //     },
      //     {
      //       groupId: 999,
      //       title: 'Repeating Event',
      //       start: '2020-02-09T16:00:00'
      //     },
      //     {
      //       groupId: 999,
      //       title: 'Repeating Event',
      //       start: '2020-02-16T16:00:00'
      //     },
      //   ]
      // });


      events: [{
          title: 'All Day Event',
          start: '2020-02-01'
        },
        {
          title: 'Büro einräumen',
          start: '2019-02-01 15: 00: 00+01: 00',
          end: '2019-02-01 17: 00: 00+01: 00'
        },
        {
          title: '2 Tag, 12 und 13. März ',
          start: '2020-03-12',
          end: '2020-03-14'
        },

        {
        title: '2 Tag, 12 und 13. März',
        start: '2020-03-12',
        end: '2020-03-14'
        },
      

        {
          title: 'Testevent 1 ganztägig 10. März',
          start: '2020-03-10',
          end: '2020-03-11'
        },
        {
          groupId: 999,
          title: 'Repeating Event',
          start: '2020-02-16T16:00:00'
        },
      ]
    });



    calendar.render();
  });
</script>

<div id='calendar'></div>

<?php snippet('footer') ?>