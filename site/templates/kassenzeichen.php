<?php snippet("header"); ?>
<?php snippet("page-header"); ?>

<section class="content">
  <div class="container">
    <style>
      form {
        max-width: 400px;
        margin: 0 auto;
      }

      label {
        display: block;
        margin-bottom: 5px;
      }

      input {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        box-sizing: border-box;
      }

      input[type="submit"] {
        background-color: #333;
        color: #fff;
        cursor: pointer;
      }
    </style>

    <?php
    if (kirby()->request()->is("POST") && get("submit")) {
        $data = ["kassenzeichen" => esc(get("kassenzeichen")), "betrag" => esc(get("betrag"))];
        $qrCode = generateQRCode($data);
        $qrCodeDataUri = $qrCode->toDataUri();

        $filename = $data["kassenzeichen"] . ".png";

        $qrCodeImageTag = "<img src='$qrCodeDataUri' style='max-width: 100%; height: auto;' />";
        echo $qrCodeImageTag;
        echo "<br><br>";
        echo "<a href='" . $qrCodeDataUri . "' download='$filename'>QR-Code herunterladen</a>";
    } else {
        ?>
        <form method="post">
          <div>
            <label for="kassenzeichen">Kassenzeichen:</label>
            <input type="text" id="kassenzeichen" name="kassenzeichen" required>
          </div>
          <div>
            <label for="betrag">Betrag:</label>
            <input type="text" id="betrag" name="betrag" required pattern="[0-9]+([,\.][0-9]+)?" title="Bitte gebe einen richtigen Betrag an">
          </div>
          <div>
            <input type="submit" name="submit" value="QR-Code generieren">
          </div>
        </form>

    <?php
    }
    ?>
  </div>
</section>

<?php snippet("footer"); ?>

<?php
function generateQRCode($data)
{
    $parentPage = page("kassenzeichen");
    if ($parentPage) {
        $beguenstigter = $parentPage->beguenstigter()->toText();
        $iban = $parentPage->iban()->toText();
        $verwendungszweck = $parentPage->verwendungszweck()->toText();
        $kassenzeichen = $data["kassenzeichen"];
        $betrag = $data["betrag"];

        $values = array(
            "BCD" . "\r\n" .
            "002" . "\r\n" .
            "2" . "\r\n" .
            "SCT" . "\r\n" .
            "" . "\r\n" .
            $beguenstigter . "\r\n" .
            $iban . "\r\n" .
            'EUR' . $betrag . "\r\n" .
            "" . "\r\n" .
            $kassenzeichen . "\r\n" .
            $kassenzeichen . ' ' . $verwendungszweck . "\r\n" .
            "Hint",
            "QRCode",
        );

        $qr = new Kirby\Image\QrCode(implode("\r\n", $values));
        $qr->toImage();
    } else {
        throw new Exception("Parent page not found.");
    }
    return $qr;
}
?>
