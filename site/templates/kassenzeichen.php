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

      .error-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-bottom: 20px;
      }

      .error-message {
        color: red;
        margin-bottom: 10px;
      }
    </style>

    <?php
    function validate($data)
    {
      // if kassenzeichen does not start with KF- throw error
      if (!preg_match("/^KF-/", $data["kassenzeichen"])) {
        throw new Exception("Kassenzeichen muss mit 'KF-' beginnen.");
      }
    }

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

    $error = '';

    if (kirby()->request()->is("POST") && get("submit")) {
      try {
        $kassenzeichen = get("kassenzeichen");
        $betrag = get("betrag");

        // Check if values are not null before using esc()
        $data = [
          "kassenzeichen" => is_string($kassenzeichen) ? esc($kassenzeichen) : '',
          "betrag" => is_string($betrag) ? esc($betrag) : ''
        ];

        // Validate input
        validate($data);

        $qrCode = generateQRCode($data);
        $qrCodeDataUri = $qrCode->toDataUri();

        $filename = $data["kassenzeichen"] . ".png";

        $qrCodeImageTag = "<img src='$qrCodeDataUri' style='max-width: 100%; height: auto;' />";
        echo $qrCodeImageTag;
        echo "<br><br>";
        echo "<a href='" . $qrCodeDataUri . "' download='$filename'>QR-Code herunterladen</a>";
      } catch (Exception $e) {
        $error = $e->getMessage();
      }
    }
    ?>

    <div class="error-container">
      <?php if (!empty($error)) : ?>
        <p class="error-message"><?php echo $error; ?></p>
      <?php endif; ?>
    </div>

    <form method="post">


      <!-- Input with Text prepend alt (normal) -->
      <div class="space-y-1">
        <label for="prepend_alt_normal" class="font-medium">Kassenzeichen</label>
        <div class="relative">
          <div class="pointer-events-none absolute inset-y-0 left-0 my-px ml-px flex w-20 items-center rounded-l-lg border-r border-gray-200 bg-gray-100 pl-3 text-gray-700 dark:border-gray-600 dark:bg-gray-900/50 dark:text-gray-300">
            KF-
          </div>
          <input type="text" id="kassenzeichen" name="kassenzeichen" placeholder="2023-2024-Paris" class="block w-full rounded-lg border border-gray-200 py-2 pl-24 pr-3 leading-6 placeholder-gray-500 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:placeholder-gray-400 dark:focus:border-indigo-500" value="<?php echo isset($data["kassenzeichen"]) ? $data["kassenzeichen"] : ''; ?>" required>
        </div>
      </div>
      <!-- END Input with Text prepend alt (normal) -->

      <!-- Input with Text prepend alt (large) -->
      <div class="space-y-1">
        <label for="prepend_alt_large" class="font-medium">Betrag</label>
        <div class="relative">
          <div class="pointer-events-none absolute inset-y-0 left-0 my-px ml-px flex w-16 items-center rounded-l-lg border-r border-gray-200 bg-gray-100 pl-3 text-gray-700 dark:border-gray-600 dark:bg-gray-900/50 dark:text-gray-300">
            €
          </div>
          <input type="text" id="betrag" name="betrag" value="<?php echo isset($data["betrag"]) ? $data["betrag"] : ''; ?>" required pattern="[0-9]+([,\.][0-9]+)?" title="Bitte gebe einen richtigen Betrag an" placeholder="333" class="block w-full rounded-lg border border-gray-200 py-3 pl-20 pr-5 leading-6 placeholder-gray-500 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:placeholder-gray-400 dark:focus:border-indigo-500" />
        </div>
        <div>
          <input type="submit" name="submit" value="QR-Code generieren">
        </div>
        <!-- END Input with Text prepend alt (large) -->
    </form>
  </div>
</section>

<?php snippet("footertw"); ?>