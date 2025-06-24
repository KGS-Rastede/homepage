<?php snippet('default-page-layout', slots: true);
slot();
?>


<div class="bg-white py-24 sm:py-32">
  <div class="mx-auto max-w-7xl px-6 lg:px-8">
    <div class="mx-auto max-w-2xl lg:mx-0">
      <p class="mt-2 text-lg leading-8 text-gray-600">
        <?= $page->Lehrplantext()->kirbytext() ?>
      </p>
    </div>
    <div
      class="mx-auto mt-10 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 border-t border-gray-200 pt-10 sm:mt-16 sm:pt-16 lg:mx-0 lg:max-w-none lg:grid-cols-3">


      <article class="flex max-w-xl flex-col items-start justify-between">
        <div class="flow-root">
          <h1 class="my-8 text-2xl font-bold tracking-tight text-gray-900 sm:text-6xl">Unterricht</h1>

          <ul role="list" class="-mb-8">
            <?php foreach ($page->Unterricht()->toFiles() as $datei): ?>
              <li>
                <div class="relative pb-8">
                  <span class="absolute left-4 top-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                  <div class="relative flex space-x-3">
                    <div>
                      <span class="h-8 w-8 rounded-full bg-slate-300 flex items-center justify-center ring-8 ring-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                          stroke="currentColor" class="w-6 h-6">
                          <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                        </svg>
                      </span>
                    </div>
                    <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                      <div>
                        <p class="text-sm text-gray-500">
                          <?= $datei->extension() ?>
                          <a href="<?= $datei->url() ?>" class="font-medium text-gray-900">
                            <?= $datei->Anzeigename()->or($datei->name()) ?>
                          </a>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </li>
            <?php endforeach; ?>
            <li>
              <div class="relative pb-8">
                <span class="absolute left-4 top-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                <div class="relative flex space-x-3">
                  <div>
                    <span class="h-8 w-8 rounded-full bg-slate-300 flex items-center justify-center ring-8 ring-white">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                          d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                      </svg>
                    </span>

                  </div>
                  <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                    <div>
                      <p class="text-sm text-gray-500">
                        <?= $datei->extension() ?>
                        <a href="<?= page(
                          '/allgemeines/schulbuchlisten',
                        )->url() ?>" class="font-medium text-gray-900">
                          Schulbuchlisten
                        </a>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </li>




          </ul>
        </div>

      </article>

      <article class="flex max-w-xl flex-col items-start justify-between">

        <div class="flow-root">
          <h1 class="my-8 text-2xl font-bold tracking-tight text-gray-900 sm:text-6xl">Datenschutz</h1>

          <ul role="list" class="-mb-8">
            <?php foreach ($page->Datenschutz()->toFiles() as $datei): ?>
              <li>
                <div class="relative pb-8">
                  <span class="absolute left-4 top-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                  <div class="relative flex space-x-3">
                    <div>
                      <span class="h-8 w-8 rounded-full bg-slate-300 flex items-center justify-center ring-8 ring-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                          stroke="currentColor" class="w-6 h-6">
                          <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                        </svg>
                      </span>
                    </div>
                    <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                      <div>
                        <p class="text-sm text-gray-500">
                          <?= $datei->extension() ?>
                          <a href="<?= $datei->url() ?>" class="font-medium text-gray-900">
                            <?= $datei->Anzeigename()->or($datei->name()) ?>
                          </a>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </li>

            <?php endforeach; ?>
            <li>
              <div class="relative pb-8">
                <span class="absolute left-4 top-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                <div class="relative flex space-x-3">
                  <div>
                    <span class="h-8 w-8 rounded-full bg-slate-300 flex items-center justify-center ring-8 ring-white">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                          d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                      </svg>
                    </span>
                  </div>
                  <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                    <div>
                      <p class="text-sm text-gray-500">
                        <?= $datei->extension() ?>
                        <a href="<?= page(
                          '/nutzungsordnung',
                        )->url() ?>" class="font-medium text-gray-900">
                          Zugang zum Netzwerk
                        </a>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </li>
          </ul>
        </div>

      </article>


      <article class="flex max-w-xl flex-col items-start justify-between">

        <div class="flow-root">
          <h1 class="my-8 text-2xl font-bold tracking-tight text-gray-900 sm:text-6xl">Schule</h1>

          <ul role="list" class="-mb-8">
            <?php foreach ($page->Schule()->toFiles() as $datei): ?>
              <li>
                <div class="relative pb-8">
                  <span class="absolute left-4 top-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                  <div class="relative flex space-x-3">
                    <div>
                      <span class="h-8 w-8 rounded-full bg-slate-300 flex items-center justify-center ring-8 ring-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                          stroke="currentColor" class="w-6 h-6">
                          <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                        </svg>
                      </span>
                    </div>
                    <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                      <div>
                        <p class="text-sm text-gray-500">
                          <?= $datei->extension() ?>
                          <a href="<?= $datei->url() ?>" class="font-medium text-gray-900">
                            <?= $datei->Anzeigename()->or($datei->name()) ?>
                          </a>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </li>
            <?php endforeach; ?>
            <li>
              <div class="relative pb-8">
                <span class="absolute left-4 top-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                <div class="relative flex space-x-3">
                  <div>
                    <span class="h-8 w-8 rounded-full bg-slate-300 flex items-center justify-center ring-8 ring-white">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                          d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                      </svg>
                    </span>
                  </div>
                  <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                    <div>
                      <p class="text-sm text-gray-500">
                        <?= $datei->extension() ?>
                        <a href="<?= page(
                          '/allgemeines/schulbuchlisten',
                        )->url() ?>" class="font-medium text-gray-900">
                          Schulbuchlisten
                        </a>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </li>




          </ul>
        </div>

      </article>


      <!-- More posts... -->
    </div>
  </div>
</div>


<?php endslot(); ?>
<?php endsnippet(); ?>
