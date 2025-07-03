<!-- 
  site/blueprints/blocks/geschichtszeitraum.php
 -->


<!-- Timeline: Centered Simple -->
<div class="relative py-5 dark:text-gray-100">
  <!-- Vertical Guide -->
  <div
    class="absolute top-0 bottom-0 left-0 flex w-10 flex-col justify-center md:w-12 lg:left-1/2 lg:-ml-6"
    aria-hidden="true"
  >
    <div
      class="mx-auto h-2.5 w-1 grow-0 rounded-t bg-linear-to-b from-transparent to-indigo-100 dark:to-indigo-900"
    ></div>
    <div class="mx-auto w-1 grow bg-indigo-100 dark:bg-indigo-900"></div>
    <div
      class="mx-auto h-2.5 w-1 grow-0 rounded-b bg-linear-to-t from-transparent to-indigo-100 dark:to-indigo-900"
    ></div>
  </div>
  <!-- END Vertical Guide -->

  <!-- Timeline -->
  <ul class="relative space-y-4 pl-10 md:pl-12 lg:pl-0">
    <?php if ($block->ereignis1()->isNotEmpty()): ?>
  <?= snippet('geschichtsereignis-links', ['ereignistext' => $block->ereignis1()]) ?>
<?php endif ?>

<?php if ($block->ereignis2()->isNotEmpty()): ?>
  <?= snippet('geschichtsereignis-rechts', ['ereignistext' => $block->ereignis2()]) ?>
<?php endif ?>

<?php if ($block->ereignis3()->isNotEmpty()): ?>
  <?= snippet('geschichtsereignis-links', ['ereignistext' => $block->ereignis3()]) ?>
<?php endif ?>

<?php if ($block->ereignis4()->isNotEmpty()): ?>
  <?= snippet('geschichtsereignis-rechts', ['ereignistext' => $block->ereignis4()]) ?>
<?php endif ?>

<?php if ($block->ereignis5()->isNotEmpty()): ?>
  <?= snippet('geschichtsereignis-links', ['ereignistext' => $block->ereignis5()]) ?>
<?php endif ?>

<?php if ($block->ereignis6()->isNotEmpty()): ?>
  <?= snippet('geschichtsereignis-rechts', ['ereignistext' => $block->ereignis6()]) ?>
<?php endif ?>

<?php if ($block->ereignis7()->isNotEmpty()): ?>
  <?= snippet('geschichtsereignis-links', ['ereignistext' => $block->ereignis7()]) ?>
<?php endif ?>

<?php if ($block->ereignis8()->isNotEmpty()): ?>
  <?= snippet('geschichtsereignis-rechts', ['ereignistext' => $block->ereignis8()]) ?>
<?php endif ?>

<?php if ($block->ereignis9()->isNotEmpty()): ?>
  <?= snippet('geschichtsereignis-links', ['ereignistext' => $block->ereignis9()]) ?>
<?php endif ?>

<?php if ($block->ereignis10()->isNotEmpty()): ?>
  <?= snippet('geschichtsereignis-rechts', ['ereignistext' => $block->ereignis10()]) ?>
<?php endif ?>

  </ul>
  <!-- END Timeline -->
</div>
<!-- END Timeline: Centered Simple -->
