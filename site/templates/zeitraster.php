<?php snippet('default-page-layout', ['sidebarEnabled' => true], slots: true);
slot();
?>

<?= $page->text()->toBlocks() ?>

<div class="my-8 flow-root">
  <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
      <table class="min-w-full divide-y divide-gray-300">
        <thead>
          <tr>
            <th scope="col" class="text-center px-3 py-3.5 font-semibold text-gray-900">Stunde
            </th>

            <th scope="col" class="px-3 py-3.5 text-left font-semibold text-gray-900">von</th>
            <th scope="col" class="px-3 py-3.5 text-left font-semibold text-gray-900">bis</th>

          </tr>
        </thead>
        <tbody>
          <tr class="even:bg-gray-50 odd:bg-slate-300">
            <td class="text-center">1</td>
            <td>08.00</td>
            <td>08.45</td>
          </tr>
          <tr class="even:bg-gray-50 odd:bg-slate-300">
            <td class="text-center">2</td>
            <td>08.55</td>
            <td>09.40</td>
          </tr>
          <tr class="even:bg-gray-50 odd:bg-slate-300">
            <td class="text-center">3/4</td>
            <td>10.00</td>
            <td>11.30</td>
          </tr>
          <tr class="even:bg-gray-50 odd:bg-slate-300">
            <td class="text-center">5</td>
            <td>11.50</td>
            <td>12.35</td>
          </tr>
          <tr class="even:bg-gray-50 odd:bg-slate-300">
            <td class="text-center">6</td>
            <td>12.45</td>
            <td>13.30</td>
          </tr>
          <tr class="even:bg-gray-50 odd:bg-slate-300">
            <td class="text-center">Mittagspause</td>
            <td>13.30</td>
            <td>14.30</td>
          </tr>
          <tr class="even:bg-gray-50 odd:bg-slate-300">
            <td class="text-center">7/8</td>
            <td>14.30</td>
            <td>16.00*</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php endslot(); ?>
<?php endsnippet(); ?>
