<?php snippet('header') ?>

<?php snippet('page-header') ?>

<?= $page->Lehrplantext()->kirbytext() ?>


<div class="col-lg-8 col-md-10 ml-auto mr-auto">
  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th>Verknüpfung</th>
        </tr>
      </thead>
      <tbody>

        <?php foreach ($page->inhalte()->toStructure() as $lehrplan) : ?>
          <tr>
            <td><?= $lehrplan->name() ?></td>
            <td class="td-actions text-right">
              <a href="<?= $lehrplan->link()->toFile()->url() ?>">
                <button type="button" rel="tooltip" class="btn btn-info btn-just-icon btn-sm">
                  Download
                  <svg class="bi" width="24" height="24">
                    <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#cloud-download" />
                  </svg>
                </button>
              </a>
            </td>
          </tr>
        <?php endforeach ?>

      </tbody>
    </table>
  </div>
</div>

<?php snippet('footer') ?>