<?php snippet('header'); ?>
<?php snippet('page-header'); ?>

<?php snippet('kalender_vorbereiten'); ?>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    window.KgsCalendar.initPageCalendar(calendarEl, {
      url: calendarEl.dataset.calendarUrl,
      loadingSelector: '#calendar-loading',
      errorSelector: '#calendar-error',
    });
  });
</script>

<main>
  <div class="p-1 md:p-3 lg:px-8 mb-2">
    <p id="calendar-loading" class="kgs-calendar-status" hidden>Kalender wird geladen ...</p>
    <p id="calendar-error" class="kgs-calendar-status kgs-calendar-status-error" hidden>
      Die Kalenderdaten konnten nicht geladen werden.
    </p>
    <div id="calendar" data-calendar-url="<?= $kirby->url('assets') ?>/kalender/public.ics"></div>
  </div>
</main>

<?php snippet('footertw'); ?>
