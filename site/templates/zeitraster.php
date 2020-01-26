<?php snippet('header') ?>
<?php snippet('page-header') ?>

<table class="table table-borderless table-hover table-striped">
    <!-- https://getbootstrap.com/docs/4.4/content/tables/ -->
    <caption>Zeittafel</caption>
    <thead>
        <tr>
            <th>Stunde</th>
            <th>von</th>
            <th>bis</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="text-center">1</td>
            <td>08.00</td>
            <td>08.45</td>
        </tr>
        <tr>
            <td class="text-center">2</td>
            <td>08.55</td>
            <td>09.40</td>
        </tr> 
        <tr>
            <td class="text-center">3/4</td>
            <td>10.00</td>
            <td>11.30</td>
        </tr>  
        <tr>
            <td class="text-center">5</td>
            <td>11.50</td>
            <td>12.35</td>
        </tr>
        <tr>
            <td class="text-center">6</td>
            <td>12.45</td>
            <td>13.30</td>
        </tr> 
        <tr>
            <td>Mittagspause</td>
            <td colspan="2">13.30 Uhr bis 14.30 Uhr</td>
        </tr>
        <tr>
            <td class="text-center">7-8</td>
            <td>14.30</td>
            <td>16.00</td>
        </tr>       
    </tbody>
</table>

<?php snippet('footer') ?>