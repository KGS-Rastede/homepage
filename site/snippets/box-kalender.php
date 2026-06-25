<style>
    .font-size-1 {
        font-size: 1rem;
    }

    @media (min-width: 576px) {
        .font-size-sm-1-2 {
            font-size: 1.2rem !important;
        }
    }

    .fc-scroller {
        position: relative;
        overflow: scroll !important;
    }
</style>

<?php snippet('kalender_vorbereiten'); ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        window.KgsCalendar.initHomepageCalendar(calendarEl, {
            url: calendarEl.dataset.calendarUrl,
            loadingSelector: '#calendar-box-loading',
            errorSelector: '#calendar-box-error',
        });
    });
</script>

<p id="calendar-box-loading" class="kgs-calendar-status" hidden>Termine werden geladen ...</p>
<p id="calendar-box-error" class="kgs-calendar-status kgs-calendar-status-error" hidden>
    Die Kalenderdaten konnten nicht geladen werden.
</p>

<div class="mt-5 rounded-lg bg-white shadow-sm dark:bg-slate-800 dark:text-slate-100">
    <div id="calendar" data-calendar-url="<?= $kirby->url('assets') ?>/kalender/public.ics"></div>
</div>
