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

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar/main.min.css" />
<script src='https://cdn.jsdelivr.net/npm/fullcalendar/main.min.js'></script>
<script src='https://github.com/mozilla-comm/ical.js/releases/download/v1.4.0/ical.js'></script>
<script src='https://cdn.jsdelivr.net/npm/@fullcalendar/icalendar/main.global.js'></script>

<?php include('./assets/kalender/kalender-update.php'); // Den code für das automatische update laden
$cache_file = './assets/kalender/cache.txt';
$ics_file = './assets/kalender/public.ics';
$update = new kalender_update($cache_file, $ics_file); // neue Klassen mit Cache datei und kalender datei Ort erzeugen

// Hauptmethode ausführen
// Es wird entweder `true` zurückgegeben, wenn der Kalender breits uptodate wahr oder der Kalender erfolgreich aktualisiert wurde
// ansonsten wird `false` zurückgegebn, es ist also irgendetwas schiefgelaufen
$result = $update->checkForUpdate(); 
?>

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
            allDayText: "ganztägig",
            noEventsContent: "Keine Ereignisse anzuzeigen",
            displayEventTime: true, // don't show the time column in list view
            events: {
                /*url: 'https://kgs-rastede.eu/iserv/public/calendar/?key=1bad7fec91a3d07904543f4476774fd1',*/
                url: '<?= $kirby->url('assets') ?>/kalender/public.ics',
                format: 'ics',
                failure: function() {
                    document.getElementById('script-warning').style.display = 'block';
                },
                loading: function(bool) {
                    document.getElementById('loading').style.display =
                        bool ? 'block' : 'none';
                }
            }
        });

        calendar.render();
        calendar.refetchEvents(); //Test
    });
</script>

<span class="font-size-1 font-size-sm-1-2">
    <div class="card mt-5 mb-3">

        <?php if ($result == false) : // Falls etwas schiefgelaufen ist wird diese Fehlermeldung über dem Kalender angezeigt ?>
            <div class="container d-flex justify-content-center">
                <p class="mt-2 text-danger">Der Kalender ist möglicherweise nicht aktuell!</p>
            </div>
        <?php endif ?>
        
        <div id='calendar'></div>
    </div>
</span>