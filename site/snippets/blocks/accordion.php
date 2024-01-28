<?php if ($block->accordion()->isNotEmpty()):
  $acc = $block->accordion()->toStructure()
    ?>

  <!-- dieser Code basiert auf 
https://onclick.blog/blog/accordion-menu-with-tailwind-css-and-alpine-js

Scheint zu gehen, laut Anleitung fehlt eventuell noch:

Set [x-cloak] as display: none !important;

[x-cloak] {
    display: none !important;
}

-->

  <div x-data="{ selected: null }" class="border border-gray-200 rounded-lg" class="p-3">
    <!-- The accordion items -->
    <div class="[&>*]:border-b [&>*]:border-b-gray-200 last:[&>*]:border-b-0">
      <?php $accordion = $acc->first() // erstes Element aus der Struktur erhalten ?>

      <div>
        <!-- The button that toggles the accordion item -->
        <button @click="selected !== 1 ? selected = 1 : selected = null"
          class="w-full flex justify-between items-center p-3 ">
          <!-- The title of the accordion item -->
          <h3 class="text-sm font-semibold">
            <?= $accordion->accordionheading()->or("Hier fehlt noch eine Überschrift") ?>
          </h3>
          <!-- The icon that indicates whether the accordion item is expanded or collapsed -->
          <div>
            <span class="text-lg transition-all block" :class="selected === 1 ? 'rotate-45' : ''">+</span>
          </div>
        </button>
        <div x-cloak x-show="selected === 1" class="text-sm text-black/50 p-3"
          x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95">
          <?= $accordion->accordionbody()->kt()->or("Hier fehlt noch Inhalt") ?>
        </div>
      </div>

      <?php $acc = $acc->slice(1) // das erste Item aus der Struktur entfernen, diese wurde bereits bearbeitet ?>

      <?php foreach ($acc as $accordion): ?>
        <div>
          <button @click="selected !== 2 ? selected = 2 : selected = null"
            class="w-full flex justify-between items-center p-3 ">
            <h3 class="font-semibold">

              <?= $accordion->accordionheading()->or("Hier fehlt noch ein Überschrift") ?>

            </h3>
            <div>
              <span class="text-lg transition-all block" :class="selected === 2 ? 'rotate-45' : ''">+</span>
            </div>
          </button>
          <div x-cloak x-show="selected === 2" class="text-sm text-black/50 p-3"
            x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95">
            <?= $accordion->accordionbody()->kt()->or("Hier fehlt noch Inhalt") ?>
          </div>
        </div>

      <?php endforeach ?>

    </div>
  </div>
<?php endif ?>