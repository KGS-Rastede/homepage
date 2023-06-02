<?php

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
    return $this->localFilePath && F::exists($this->localFilePath) && (F::size($this->localFilePath) > 0);
  }

  public function isStale()
  {
    if (!$this->isLocal()) return true;

    return (time() - F::modified($this->localFilePath)) > 86400;
  }

  public function download()
  {
    $headers = [];

    if ($this->isLocal()) {
      $headers['If-Modified-Since'] = F::modified($this->localFilePath, DATE_RFC822);
    }

    $request = Remote::get($this->url, ['headers' => $headers]);

    if ($request->code() === 200) {
      $this->writeFileAfterDownload($request);
    } else if ($request->code() === 304) {
      F::touch($this->localFilePath);
    }
  }

  private function findLocalFilePath()
  {
    $files = glob($this->pageRoot . DS . $this->id . '.*');

    if (!$files || empty($files)) {
      return null;
    }

    return $files[0];
  }

  private function writeFileAfterDownload($request)
  {
    $fileExtension = Mime::toExtension($request->info['content_type']);

    $newPath = $this->pageRoot . DS . $this->id . '.' . $fileExtension;

    if ($this->localFilePath && ($newPath != $this->localFilePath)) {
      F::remove($this->localFilePath);

      $this->localFilePath = $newPath;
    }

    F::write($newPath, $request->content());
  }
}

class ArbeitsgemeinschaftPage extends Page
{
  public function images() : Files
  {
    if ($this->content->image_url()->isEmpty()) return parent::images();

    $study_group_image = new StudyGroupImage($this->slug(), $this->content->image_url(), $this->root());

    if (!$study_group_image->isLocal() || $study_group_image->isStale()) {
      $study_group_image->download();
    }

    return parent::images();
  }
}

?>
