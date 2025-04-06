<?php snippet('default-page-layout', slots: true);
slot();
?>

<?= $page->text()->toBlocks() ?>

<div class="grid grid-cols-1 py-2 gap-8  text-center sm:grid-cols-2 lg:py-4 lg:grid-cols-3">
  <?php foreach ($page->children() as $kontakt): ?>

    <div class="group bg-slate-100 p-2 lg:p-4">
      <div class="mb-4">
        <img class="aspect-[2/3] w-full rounded-2xl object-cover"
          src="<?= $kontakt->images()->first()->url() ?>" />
        <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
          <?= $kontakt->title() ?>
        </h3>
        <p class="mt-3 text-slate-600">
          <?= $kontakt->position() ?>
        </p>
      </div>

      <?php if (
        $kontakt->phone()->isNotEmpty() or $kontakt->email()->isNotEmpty()
      ): ?>
        <div>
          <?php if ($kontakt->phone()->isNotEmpty()): ?>
            <p>
              <i class="bi bi-phone"></i>

              <?= $kontakt->phone() ?>
            </p>
          <?php endif; ?>

          <?php if ($kontakt->email()->isNotEmpty()): ?>
            <p>
              <i class="bi bi-envelope"></i>

              <script type="text/javascript">
                var mail = "<?= $kontakt->heading() ?>";
                var en = "eu";
                var dom = "kgs-rastede";
                var at = "@";
                document.open();
                document.write(unescape("%3Ca href='mailto:" + mail + at + dom + "." + en + "'%3E" + mail + at + dom + "." + en + "%3C/a%3E"));
                document.close();
              </script>
            </p>
          <?php endif; ?>
        </div>
      <?php endif; ?>

    </div>

  <?php endforeach; ?>
</div>

<?php snippet('sidebar'); ?>

<?php endslot(); ?>
<?php endsnippet(); ?>
