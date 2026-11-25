<?php

use Kirby\Cms\Files;
use Kirby\Cms\Page;
use Kirby\Filesystem\F;
use Kirby\Filesystem\Mime;
use Kirby\Http\Remote;

/**
 * Represents an image for a Study Group.
 *
 * Downloads the image file from the Study Group Manager website and caches it locally. Checks if the image has changed
 * once per day.
 *
 */
class StudyGroupImage
{
    public $id;
    public $url;
    public $pageRoot;

    private $mediaFolder;
    private $localFilePath;

    function __construct($id, $url, $pageRoot)
    {
        $this->id = $id;
        $this->url = $url;
        $this->pageRoot = $pageRoot;
        $this->localFilePath = $this->findLocalFilePath();
    }

    public function isLocal()
    {
        return $this->localFilePath &&
            F::exists($this->localFilePath) &&
            F::size($this->localFilePath) > 0;
    }

    public function isStale()
    {
        if (!$this->isLocal()) {
            return true;
        }

        return time() - F::modified($this->localFilePath) > 86400;
    }

    public function download()
    {
        $headers = [];

        if ($this->isLocal()) {
            $headers['If-Modified-Since'] = F::modified(
                $this->localFilePath,
                DATE_RFC822,
            );
        }

        $request = Remote::get($this->url, ['headers' => $headers]);

        if ($request->code() === 200) {
            $this->writeFileAfterDownload($request);
        } elseif ($request->code() === 304) {
            F::touch($this->localFilePath);
        }
    }

    private function findLocalFilePath()
    {
        $files = glob($this->pageRoot . '/' . $this->id . '.*');

        if (!$files || empty($files)) {
            return null;
        }

        return $files[0];
    }

    private function writeFileAfterDownload($request)
    {
        $fileExtension = Mime::toExtension($request->info['content_type']);

        $newPath = $this->pageRoot . '/' . $this->id . '.' . $fileExtension;

        if ($this->localFilePath && $newPath != $this->localFilePath) {
            F::remove($this->localFilePath);

            $this->localFilePath = $newPath;
        }

        F::write($newPath, $request->content());
    }
}

class ArbeitsgemeinschaftPage extends \Kgs\Bereichsrechte\BereichsPage
{
    /**
     * Jahrgänge der AG, so wie sie die AG-Schnittstelle liefert.
     */
    public function gradeList(): array
    {
        return array_map(
            'strval',
            $this->content()->grades()->toArray()['grades'] ?? [],
        );
    }

    /**
     * AG-Leitungen, so wie sie die AG-Schnittstelle liefert.
     */
    public function teacherList(): array
    {
        return $this->content()->teachers()->toArray()['teachers'] ?? [];
    }

    /**
     * Jahrgänge für die Anzeige: lückenlose Zahlenfolgen als Spanne ("5–10"),
     * alles andere unverändert mit Komma getrennt.
     */
    public function gradesLabel(): string
    {
        $grades = $this->gradeList();
        $numbers = array_map('intval', $grades);

        $isRange =
            count($grades) > 2 &&
            array_map('strval', $numbers) === $grades &&
            $numbers === range($numbers[0], $numbers[0] + count($numbers) - 1);

        return $isRange
            ? $numbers[0] . '–' . end($numbers)
            : implode(', ', $grades);
    }

    public function images(): Files
    {
        if ($this->content()->image_url()->isEmpty()) {
            return parent::images();
        }

        $study_group_image = new StudyGroupImage(
            $this->slug(),
            $this->content()->image_url(),
            $this->root(),
        );

        if (!$study_group_image->isLocal() || $study_group_image->isStale()) {
            $study_group_image->download();
        }

        return parent::images();
    }
}

?>
