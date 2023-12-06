<!-- Erzeugt einen kleinen Knopf mit der Beschriftung $knopftext, so dass das
Layout überall konsistent ist-->

<a href="<?=$subpage->url()?>"
   class="px-4 py-1 text-gray-800 font-semibold rounded-full border border-purple-200 hover:text-white hover:bg-slate-400 hover:border-transparent focus:outline-none focus:ring-2 focus:ring-slate-200 focus:ring-offset-2 text-center"
   aria-disabled="false"
   <?=isset($neuerTab) && $neuerTab ? "target=\"_blank\" rel=\"noopener\"" : "" //ternary operator
    //Fügt die benötigten Elemente hinzu wenn der Link in einem neuen Tab geöffnet werden soll -> neuerTab also true ist
    ?>>
    <?=$knopftext?>
</a>