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

<?php $result = false ?>

<?php snippet('kalender_vorbereiten') ?>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            locale: 'de', //Darstellung auf Deutsch
            height: 'auto',

            initialView: 'zweiWochen',

            headerToolbar: {
                left: '',
                center: 'title',
                right: ''
            },

            views: {
                zweiWochen: {
                    type: 'listWeek',
                    duration: {
                        days: 14
                    },
                }
            },

            stickyHeaderDates: false, //Die Terminleiste wird nicht immer oben am Bildschirm angezeigt
            firstDay: 1,
            hiddenDays: [0, 6], // Samstag und Sonntag verstecken
            allDayText: "ganztägig",
            noEventsContent: "Keine Ereignisse anzuzeigen",
            displayEventTime: true, // don't show the time column in list view
            events: {
                /*url: 'https://kgs-rastede.eu/iserv/public/calendar/?key=1bad7fec91a3d07904543f4476774fd1',*/
                url: '<?= $kirby->url('assets') ?>/kalender/public.ics',
                format: 'ics',
                failure: function () {
                    document.getElementById('script-warning').style.display = 'block';
                },
                loading: function (bool) {
                    document.getElementById('loading').style.display =
                        bool ? 'block' : 'none';
                }
            }
        });

        calendar.render();
        calendar.refetchEvents(); //Test
    });
</script>

<div class="mt-5 rounded-lg bg-white shadow-sm dark:bg-slate-800 dark:text-slate-100">
    <div id='calendar'></div>
</div>