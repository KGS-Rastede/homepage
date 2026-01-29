<div class="flex flex-col justify-center gap-1 md:flex-row md:gap-4 mx-2 sm:mx-6 lg:mx-12 my-6">


    <?= snippet('knopf-gross', [
        'subpage' => page('schule/oberstufe'),
        'knopftext' => 'Information Oberstufe',
    ]) ?>

    <?= snippet('knopf-gross', [
        'subpage' => page('blogs/anmeldung-5'),
        'knopftext' => 'Anmeldung JG 5',
    ]) ?>

    <?= snippet('knopf-gross', [
        'subpage' => page('allgemeines/schulbuchlisten'),
        'knopftext' => 'Schulbücher',
    ]) ?>
</div>