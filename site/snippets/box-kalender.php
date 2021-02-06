<div class="card bg-primary mt-5 mb-3">
    <link href='<?= $kirby->url('assets') ?>/js/plugins/main.min.css' rel='stylesheet' />

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.13.0/css/all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar/main.min.css">


    <script src='https://cdn.jsdelivr.net/npm/fullcalendar/main.min.js'></script>
    

    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
                weekLabel: "KW", // Beschriftung der Kalenderwoche
                allDayText: "ganztägig",
                noEventsContent: "Keine Ereignisse anzuzeigen",
                displayEventTime: true, // don't show the time column in list view
                events: '<?= $kirby->url('assets') ?>/kalender/schuljahresplaner.json'
            });

            calendar.render();
            calendar.refetchEvents(); //Test
        });
    </script>

    <div id='calendar'></div>
</div>