<?php //Die Tabelle wird mit dem table-field plugin verarbeitet: https://getkirby.com/plugins/ragi96/table-field
$table_head = $block->tabellehead()->toTable();
$table_body = $block->tabellebody()->toTable();
$empty_head = true;
$empty_body = true;

//Zuerst muss überprüft werden, ob die Tabellen leer sind. Da die Tabellen, aber aus einem array in einem anderen array bestehen ist das etwas umständlicher
if(isset($table_head)) : //gibt es eine Tabelle?
  foreach ($table_head as $tableRow): //Es wird überprüft ob die Tabellen-Überschirft komplett leer ist
    foreach ($tableRow as $tableCell) :
      if(!empty($tableCell))
        $empty_head = false; //Falls irgendwo Inhalt gefunden wird, wird die Variable auf falsch gesetzt
    endforeach;
  endforeach;
endif;

if(isset($table_body)) : //gibt es eine Tabelle?
  foreach ($table_body as $tableRow): //Es wird überprüft ob die Tabellen-Inhalt komplett leer ist
    foreach ($tableRow as $tableCell) :
      if(!empty($tableCell))
        $empty_body = false; //Falls irgendwo Inhalt gefunden wird, wird die Variable auf falsch gesetzt
    endforeach;
  endforeach;
endif; ?>


<?php if(!$empty_head) : //Wenn der Tabellen-Kopf nicht leer ist wird die Tabelle angelegt und die Überschrift eingefügt?>
    <div class="table-responsive">
      <table class="table">
        <thead>
        <?php foreach ($table_head as $tableRow): ?>
          <tr>
            <?php foreach ($tableRow as $tableCell): ?>
              <th><?= $tableCell ?></th>
            <?php endforeach ?>
          </tr>
        <?php endforeach ?>
        </thead>

  <?php if($empty_body) : //Wenn danach kein Tabellen-Inhalt kommt -> Tabelle beenden ?>
      </table>
    </div>
  <?php endif ?>
  
<?php endif ?>

<?php if(!$empty_body) : //Wenn Tabellen-Inhalt nicht leer ist wird der Inhalt eingefügt ?>

  <?php if($empty_head) : //Wenn davor kein Tabellen-Kopf war -> neue Tabelle starten ?>
    <div class="table-responsive">
      <table class="table">
  <?php endif ?>

        <tbody>
        <?php foreach ($table_body as $tableRow): ?>
          <tr>
            <?php foreach ($tableRow as $tableCell): ?>
              <td><?= $tableCell ?></td>
            <?php endforeach ?>
          </tr>
        <?php endforeach ?>
        </tbody>

      </table>
    </div>

<?php endif ?>