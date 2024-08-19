<?php if (page('wichtige-informationen')->toggle()->bool() === true) :
    /* 
        An besonderen Tagen (Schneefrei, Heizungsbruch, ...) soll ganz schnell
        ein Banner angezeigt werden, damit die Eltern schnell informiert werden können
    */
?>



    <div class="rounded-lg border-8 border-dashed border-gray-800">
        <article class="bg-red-400 py-8 px-8 text-2xl leading-10 prose-h1:text-lg dark:bg-gray-700/25 prose-a:text-blue-600">
            <h1><?php page('wichtige-informationen')->textTitel() ?></h1>

            <?= page('wichtige-informationen')->text()->kt() ?>
        </article>
    </div>

<?php endif ?>