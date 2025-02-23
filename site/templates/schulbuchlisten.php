<?php snippet('default-page-layout', slots: true);
slot();
?>

<div>
  <?= $page->text()->toBlocks() ?>
</div>

<div class="mt-4">
  <?= $page->Subtitletext1() ?>
</div>


<div class="grid grid-cols-1 gap-x-8 gap-y-16 border-gray-200 pt-10 lg:grid-cols-3">
  <div class="flex flex-col items-start justify-between">
    <div class="group relative">
      <?php foreach ($page->SchulbuchlistenHZ()->toStructure() as $liste): ?>
        <dl class="space-y-6 border-t border-gray-200 pt-6 text-sm font-medium text-gray-500">

          <div class="flex justify-between p-2">
            <dt>
              <?= $liste->name() ?>
            </dt>
            <dd class="text-gray-900">
              <a href="<?= $liste->link()->toFile()->url() ?>">
                <button type="button"
                  class="ml-5 rounded-full bg-slate-100 p-1.5 text-black shadow-sm hover:bg-slate-300 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-slate-900">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                    fill="currentColor" class="bi bi-file-earmark-arrow-down"
                    viewBox="0 0 16 16">
                    <path
                      d="M8.5 6.5a.5.5 0 0 0-1 0v3.793L6.354 9.146a.5.5 0 1 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 10.293z" />
                    <path
                      d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z" />
                  </svg>
                </button>
              </a>
            </dd>
          </div>
        </dl>
      <?php endforeach; ?>
    </div>
  </div>

  <div class="flex max-w-xl flex-col items-start justify-between">
    <div class="group relative">
      <?php foreach ($page->SchulbuchlistenRZ()->toStructure() as $liste): ?>
        <dl class="space-y-6 border-t border-gray-200 pt-6 text-sm font-medium text-gray-500">
          <div class="flex justify-between">
            <dt>
              <?= $liste->name() ?>
            </dt>
            <dd class="text-gray-900">
              <a href="<?= $liste->link()->toFile()->url() ?>">
                <button type="button"
                  class="ml-5 rounded-full bg-slate-100 p-1.5 text-black shadow-sm hover:bg-slate-300 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-slate-900">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                    fill="currentColor" class="bi bi-file-earmark-arrow-down"
                    viewBox="0 0 16 16">
                    <path
                      d="M8.5 6.5a.5.5 0 0 0-1 0v3.793L6.354 9.146a.5.5 0 1 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 10.293z" />
                    <path
                      d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z" />
                  </svg>
                </button>
              </a>
            </dd>
          </div>
        </dl>
      <?php endforeach; ?>
    </div>
  </div>

  <div class="flex max-w-xl flex-col items-start justify-between">
    <div class="group relative">
      <?php foreach ($page->SchulbuchlistenGZ()->toStructure() as $liste): ?>
        <dl class="space-y-6 border-t border-gray-200 pt-6 text-sm font-medium text-gray-500">
          <div class="flex justify-between">
            <dt>
              <?= $liste->name() ?>
            </dt>
            <dd class="text-slate-900">
              <a href="<?= $liste->link()->toFile()->url() ?>">
                <button type="button"
                  class="ml-5 rounded-full bg-slate-100 p-1.5 text-black shadow-sm hover:bg-slate-300 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-slate-900">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                    fill="currentColor" class="bi bi-file-earmark-arrow-down"
                    viewBox="0 0 16 16">
                    <path
                      d="M8.5 6.5a.5.5 0 0 0-1 0v3.793L6.354 9.146a.5.5 0 1 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 10.293z" />
                    <path
                      d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z" />
                  </svg>
                </button>
              </a>
            </dd>
          </div>
        </dl>
      <?php endforeach; ?>
    </div>
  </div>
</div>

<?php endslot(); ?>
<?php endsnippet(); ?>
